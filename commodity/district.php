<?php
$host = 'localhost';
$user = 'root';
$password = 'Sam@1357912';
$dbname = 'ssd_project';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the stored procedure exists
$checkProcedureQuery = "
    SELECT ROUTINE_NAME 
    FROM INFORMATION_SCHEMA.ROUTINES 
    WHERE ROUTINE_TYPE = 'PROCEDURE' 
    AND ROUTINE_SCHEMA = ? 
    AND ROUTINE_NAME = 'compare_district_prices';
";
$stmt = $conn->prepare($checkProcedureQuery);
$stmt->bind_param("s", $dbname);
$stmt->execute();
$stmt->store_result();

// If the procedure doesn't exist, create it
if ($stmt->num_rows === 0) {
    $createProcedureQuery = "
        CREATE PROCEDURE compare_district_prices(IN selected_state VARCHAR(50), IN selected_commodity VARCHAR(50))
        BEGIN
            SELECT District, ROUND(AVG(Modal_Price), 2) AS Average_Price
            FROM prices_commodities
            WHERE State = selected_state AND Commodity = selected_commodity
            GROUP BY District
            ORDER BY District;
        END;
    ";
    
    if ($conn->query($createProcedureQuery) === TRUE) {
        echo "Stored procedure created successfully.";
    } else {
        die("Error creating stored procedure: " . $conn->error);
    }
}

// Fetch data for the selected state and commodity
$selected_state = isset($_GET['state']) ? $_GET['state'] : null;
$selected_commodity = isset($_GET['commodity']) ? $_GET['commodity'] : null;

if ($selected_state && $selected_commodity) {
    // Call the stored procedure
    $stmt = $conn->prepare("CALL compare_district_prices(?, ?)");
    $stmt->bind_param("ss", $selected_state, $selected_commodity);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Return data as JSON
    echo json_encode($data);

    $stmt->close();
}

$conn->close();
?>
