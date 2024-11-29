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

// Fetching satisfaction data from the database
$sql = "SELECT Industry, Satisfaction_with_Remote_Work, COUNT(*) AS count
        FROM employee_data 
        GROUP BY Industry, Satisfaction_with_Remote_Work";
$result = $conn->query($sql);

$satisfactionData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $industry = $row['Industry'];
        $satisfaction = $row['Satisfaction_with_Remote_Work'];
        $count = (int)$row['count'];
        $satisfactionData[$industry][$satisfaction] = $count;
    }
} else {
    echo "0 results";
}

$conn->close();

// Convert PHP array to JSON for use in JavaScript
$satisfactionDataJson = json_encode($satisfactionData);
?>
