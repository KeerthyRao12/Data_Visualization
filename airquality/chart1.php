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

// Query to get city names and average values
$sql = "SELECT city_name, avg FROM air_quality"; 
$result = $conn->query($sql);

$cityNames = [];
$avgValues = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cityNames[] = $row['city_name'];
        $avgValues[] = $row['avg'];
    }
}

// Convert data to JavaScript variables
echo "<script>
    const cityLabels = " . json_encode($cityNames) . ";
    const avgData = " . json_encode($avgValues) . ";
</script>";

$conn->close();
?>