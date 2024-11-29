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

// SQL query to fetch average monthly pollution for each city
$sql = "SELECT city_name, month, AVG(avg_pollution) AS avg_monthly_pollution 
        FROM monthly_pollution_for_city 
        GROUP BY city_name, month
        ORDER BY city_name, FIELD(month, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')";
$result = $conn->query($sql);

$pollutionData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pollutionData[$row['city_name']][] = [
            'month' => $row['month'],
            'pollution' => $row['avg_monthly_pollution']
        ];
    }
}

// Convert pollution data to JavaScript variables
echo "<script>
    const pollutionData = " . json_encode($pollutionData) . ";
</script>";

$conn->close();
?>
