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

// Query to get city names and worst pollution months
$sql = "SELECT City, WorstMonth FROM WorstPollutionMonths"; 
$result = $conn->query($sql);

$cityNames = [];
$worstMonths = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cityNames[] = $row['City'];
        $worstMonths[] = $row['WorstMonth'];
    }
}

// Convert data to JavaScript variables
echo "<script>
    const cityLabelsPollution = " . json_encode($cityNames) . ";
    const worstMonthData = " . json_encode($worstMonths) . ";
</script>";

$conn->close();
?>
