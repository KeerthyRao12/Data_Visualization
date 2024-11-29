<?php
$host = 'localhost';
$user = 'root';
$password = 'Sam@1357912';
$dbname = 'ssd_project';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$commodity = isset($_GET['commodity']) ? $_GET['commodity'] : '';
if (!$commodity) {
    echo json_encode(['error' => 'Commodity not selected']);
    exit;
}

// Query to fetch market and highest price data
$query = "
    SELECT market, MAX(modal_price) AS max_price
    FROM prices_commodities
    WHERE Commodity = ?
    GROUP BY market
    ORDER BY max_price DESC LIMIT 10;
";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $commodity); // Bind commodity
$stmt->execute();
$result = $stmt->get_result();

$marketData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $marketData[] = [
            'market' => $row['market'],
            'max_price' => $row['max_price'],
        ];
    }
    echo json_encode(['marketData' => $marketData]);
} else {
    echo json_encode(['error' => 'No data found for the selected commodity.']);
}

$stmt->close();
$conn->close();
?>
