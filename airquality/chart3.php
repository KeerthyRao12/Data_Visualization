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

// SQL query to fetch top cities with average pollution
$sql = "SELECT city_name, AVG(avg_pollution) AS avg_pollution 
        FROM top_cities_pollution
        GROUP BY city_name
        ORDER BY avg_pollution DESC
        LIMIT 15"; // Get top 15 polluted cities

$result = $conn->query($sql);

$cityPollutionData = [];
$cityNames = [];
$avgValues = [];
$rankings = [];

if ($result->num_rows > 0) {
    $rank = 1;  // Start ranking from 1
    while ($row = $result->fetch_assoc()) {
        $cityPollutionData[] = [
            'city' => $row['city_name'],
            'pollution' => $row['avg_pollution'],
            'rank' => $rank++ // Increment rank for each city
        ];

        // Prepare city names, pollution values, and rankings for chart and table
        $cityNames[] = $row['city_name'];
        $avgValues[] = $row['avg_pollution'];
        $rankings[] = $rank - 1; // Adjust for 0-based index
    }
}

// Convert data to JavaScript for visualization
echo "<script>
    const cityNames = " . json_encode($cityNames) . ";
    const avgValues = " . json_encode($avgValues) . ";
    const rankings = " . json_encode($rankings) . ";
</script>";

$conn->close();
?>
