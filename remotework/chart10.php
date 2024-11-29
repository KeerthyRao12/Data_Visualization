<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = 'Sam@1357912';  
$dbname = 'ssd_project';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching remote work distribution data from the database
$sql = "SELECT Gender, COUNT(*) AS count FROM employee_data WHERE Work_Location = 'Remote' GROUP BY Gender";
$result = $conn->query($sql);

$remoteWorkCounts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $remoteWorkCounts[] = ['gender' => $row['Gender'], 'count' => (int)$row['count']];
    }
} else {
    echo "0 results";
}

$conn->close();

// Encode the data into JSON
$remoteWorkCountsJson = json_encode($remoteWorkCounts);
?>
