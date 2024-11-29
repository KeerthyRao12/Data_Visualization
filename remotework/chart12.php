
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

// SQL query to get counts grouped by Work_Location and Stress_Level
$sql = "SELECT Work_Location, Stress_Level, COUNT(*) AS count 
        FROM employee_data 
        GROUP BY Work_Location, Stress_Level";
$result = $conn->query($sql);

$data = [];
$locations = [];
$stress_levels = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $location = $row['Work_Location'];
        $level = $row['Stress_Level'];
        $count = $row['count'];
        
        if (!isset($data[$level])) {
            $data[$level] = [];
        }
        $data[$level][$location] = $count;

        if (!in_array($location, $locations)) {
            $locations[] = $location;
        }
        if (!in_array($level, $stress_levels)) {
            $stress_levels[] = $level;
        }
    }
}

$datasets = [];
foreach ($stress_levels as $level) {
    $dataset = [
        'label' => $level,
        'data' => []    ];
    foreach ($locations as $location) {
        $dataset['data'][] = $data[$level][$location] ?? 0;
    }
    $datasets[] = $dataset;
}

$conn->close();
?>

<!-- Variables for use in the HTML section -->
<?php
$locations_js = json_encode($locations);
$datasets_js = json_encode($datasets);
?>
