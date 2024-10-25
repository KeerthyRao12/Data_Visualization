<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

// MySQL connection setup
$host = 'localhost';
$user = 'root';
$password = 'Cherry123@';
$dbname = 'ssd_project';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get commodity from URL parameters
$commodity = isset($_GET['commodity']) ? $_GET['commodity'] : '';

// SQL query for market volatility (max and min prices)
if ($commodity) {
    $sql = "SELECT MAX(Modal_Price) AS maxPrice, MIN(Modal_Price) AS minPrice FROM prices_commodities WHERE commodity = '$commodity'";
    $result = $conn->query($sql);

    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'No commodity specified']);
}

$conn->close();
?>
