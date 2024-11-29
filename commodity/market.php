<?php
$host = 'localhost';
$user = 'root';
$password = 'Sam@1357912';
$dbname = 'ssd_project';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the stored procedure exists, if not, create it
$checkProcedureQuery = "SHOW PROCEDURE STATUS WHERE Db = '$dbname' AND Name = 'GetMinMaxPriceByCommodity'";

$result = $conn->query($checkProcedureQuery);
if ($result->num_rows == 0) {
    // Stored procedure does not exist, create it
    $createProcedureQuery = "
        CREATE PROCEDURE GetMinMaxPriceByCommodity(IN commodity_name VARCHAR(255))
        BEGIN
            SELECT 
                MIN(modal_price) AS min_price,
                MAX(modal_price) AS max_price
            FROM prices_commodities
            WHERE Commodity = commodity_name;
        END;
    ";
    if ($conn->multi_query($createProcedureQuery)) {
        echo "Stored procedure created successfully.";
    } else {
        echo "Error creating stored procedure: " . $conn->error;
    }
}

// Now handle the commodity selection and fetch the results
$commodity = isset($_GET['commodity']) ? $_GET['commodity'] : '';

if (!$commodity) {
    echo json_encode(['error' => 'Commodity not selected']);
    exit;
}

// Prepare and call the stored procedure
$stmt = $conn->prepare("CALL GetMinMaxPriceByCommodity(?)");
$stmt->bind_param("s", $commodity); // "s" means the parameter is a string
$stmt->execute();
$result = $stmt->get_result();

$minPrice = null;
$maxPrice = null;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $minPrice = $row['min_price'];
    $maxPrice = $row['max_price'];

    echo json_encode([
        'minPrice' => $minPrice,
        'maxPrice' => $maxPrice
    ]);
} else {
    echo json_encode(['error' => 'No data found for the selected commodity.']);
}

$stmt->close();
$conn->close();
?>
