<?php
$host = 'localhost';
$user = 'root';
$password = 'Sam@1357912';
$dbname = 'ssd_project';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the stored procedure exists
$checkProcedureQuery = "
    SELECT ROUTINE_NAME 
    FROM INFORMATION_SCHEMA.ROUTINES 
    WHERE ROUTINE_TYPE = 'PROCEDURE' 
    AND ROUTINE_SCHEMA = ? 
    AND ROUTINE_NAME = 'calculate_cpi_inflation';
";
$stmt = $conn->prepare($checkProcedureQuery);
$stmt->bind_param("s", $dbname);
$stmt->execute();
$stmt->store_result();

// If the procedure doesn't exist, create it
if ($stmt->num_rows === 0) {
    $createProcedureQuery = "
        CREATE PROCEDURE calculate_cpi_inflation(IN selected_commodity VARCHAR(50))
        BEGIN
            DECLARE base_basket_cost INT;
            DECLARE sequence INT DEFAULT 1;
            DECLARE previous_cpi INT DEFAULT NULL;
            DECLARE current_commodity VARCHAR(50);
            DECLARE current_basket_cost INT;
            DECLARE current_cpi INT;
            DECLARE inflation_rate INT;
            DECLARE done INT DEFAULT FALSE;

            DECLARE cur CURSOR FOR
                SELECT Commodity, ROUND(AVG(Modal_Price)) AS basket_cost
                FROM prices_commodities
                WHERE Commodity = selected_commodity OR selected_commodity IS NULL
                GROUP BY Commodity
                ORDER BY Commodity ASC;

            DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

            -- Calculate base basket cost
            SELECT ROUND(AVG(Modal_Price)) INTO base_basket_cost 
            FROM prices_commodities
            WHERE Commodity = selected_commodity OR selected_commodity IS NULL;

            -- Open the cursor
            OPEN cur;

            -- Initialize temporary table to hold results
            CREATE TEMPORARY TABLE cpi_results (
                sequence INT,
                commodity VARCHAR(50),
                basket_cost INT,
                cpi INT,
                inflation_rate INT
            );

            -- Loop to calculate CPI and inflation rate for each commodity
            read_loop: LOOP
                FETCH cur INTO current_commodity, current_basket_cost;
                IF done THEN
                    LEAVE read_loop;
                END IF;

                -- Calculate CPI
                SET current_cpi = ROUND((current_basket_cost / base_basket_cost) * 100);

                -- Calculate Inflation Rate
                SET inflation_rate = IF(previous_cpi IS NOT NULL, ROUND(((current_cpi - previous_cpi) / previous_cpi) * 100), 0);

                -- Insert into temporary table
                INSERT INTO cpi_results (sequence, commodity, basket_cost, cpi, inflation_rate)
                VALUES (sequence, current_commodity, current_basket_cost, current_cpi, inflation_rate);

                -- Update variables
                SET previous_cpi = current_cpi;
                SET sequence = sequence + 1;
            END LOOP;

            -- Close the cursor
            CLOSE cur;

            -- Return the calculated results
            SELECT * FROM cpi_results;

            -- Drop the temporary table
            DROP TEMPORARY TABLE IF EXISTS cpi_results;
        END;
    ";

    // Execute the creation of the stored procedure
    if ($conn->multi_query($createProcedureQuery)) {
        while ($conn->next_result()) {;} // Handle multiple queries in multi_query
    } else {
        die("Error creating stored procedure: " . $conn->error);
    }
}

// Now you can call the stored procedure with the selected commodity
$selected_commodity = isset($_GET['commodity']) ? $_GET['commodity'] : NULL;
$stmt = $conn->prepare("CALL calculate_cpi_inflation(?)");
$stmt->bind_param("s", $selected_commodity); // "s" means the parameter is a string
$stmt->execute();
$result = $stmt->get_result();

// Prepare data for output, only including commodity and cpi
$data = [];
while ($row = $result->fetch_assoc()) {
    $row['is_selected'] = ($row['commodity'] === $selected_commodity);
    $data[] = $row;
}

echo json_encode($data);


$stmt->close();
$conn->close();
?>
