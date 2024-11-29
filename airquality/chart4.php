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

// SQL query to fetch average pollution for each city in a specific month (e.g., 'Jan')
$month = 'Jan'; // You can change this to any month you're interested in
$sql = "SELECT city_name, AVG(avg_pollution) AS avg_pollution 
        FROM monthly_pollution_for_city
        WHERE month = '$month'
        GROUP BY city_name";

$result = $conn->query($sql);

$cityPollutionData = [];
$cityNames = [];
$avgValues = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cityPollutionData[] = [
            'city' => $row['city_name'],
            'pollution' => $row['avg_pollution']
        ];

        // Prepare city names and pollution values for the chart
        $cityNames[] = $row['city_name'];
        $avgValues[] = $row['avg_pollution'];
    }
}

// Convert data to JavaScript for visualization
echo "<script>
    const cityNames = " . json_encode($cityNames) . ";
    const avgValues = " . json_encode($avgValues) . ";
</script>";

$conn->close();
?>
