<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
$host = 'localhost';
$user = 'root';
$password = 'Cherry123@';
$dbname = 'ssd_project';
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$commodity = isset($_GET['commodity']) ? $_GET['commodity'] : '';
if ($commodity) {
    $sql = "SELECT State, Modal_Price FROM prices_commodities WHERE commodity = '$commodity' ";
    $result = $conn->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} else {
    echo json_encode(['error' => 'No commodity specified']);
}
$conn->close();
?>
