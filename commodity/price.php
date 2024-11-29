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
$checkProcedureQuery = "SHOW PROCEDURE STATUS WHERE Db = '$dbname' AND Name = 'GetAvgPriceByCommodity'";

$result = $conn->query($checkProcedureQuery);
if ($result->num_rows == 0) {
    // Stored procedure does not exist, create it
    $createProcedureQuery = "
        CREATE PROCEDURE GetAvgPriceByCommodity(IN commodity_name VARCHAR(255))
        BEGIN
            SELECT state, AVG(modal_price) AS avg_price
            FROM prices_commodities
            WHERE Commodity = commodity_name
            GROUP BY state
            ORDER BY avg_price DESC;
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
$stmt = $conn->prepare("CALL GetAvgPriceByCommodity(?)");
$stmt->bind_param("s", $commodity); // "s" means the parameter is a string
$stmt->execute();
$result = $stmt->get_result();

$states = [];
$avgPrices = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $states[] = $row['state'];
        $avgPrices[] = $row['avg_price'];
    }
    echo json_encode([
        'states' => $states,
        'avgPrices' => $avgPrices
    ]);
} else {
    echo json_encode(['error' => 'No data found for the selected commodity.']);
}

$stmt->close();
$conn->close();
?>
