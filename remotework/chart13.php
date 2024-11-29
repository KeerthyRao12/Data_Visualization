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

// SQL query to get counts grouped by Work_Location and Mental_Health_Condition
$sql = "SELECT Work_Location, Mental_Health_Condition, COUNT(*) AS count 
        FROM employee_data 
        GROUP BY Work_Location, Mental_Health_Condition";
$result = $conn->query($sql);

$data = [];
$locations = [];
$conditions = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $location = $row['Work_Location'];
        $condition = $row['Mental_Health_Condition'];
        $count = $row['count'];
        
        if (!isset($data[$condition])) {
            $data[$condition] = [];
        }
        $data[$condition][$location] = $count;

        if (!in_array($location, $locations)) {
            $locations[] = $location;
        }
        if (!in_array($condition, $conditions)) {
            $conditions[] = $condition;
        }
    }
}

// Prepare datasets for Chart.js
$datasets = [];
foreach ($conditions as $condition) {
    $dataset = [
        'label' => $condition,
        'data' => [],
        // No backgroundColor here, set it in JavaScript
    ];
    foreach ($locations as $location) {
        $dataset['data'][] = $data[$condition][$location] ?? 0;
    }
    $datasets[] = $dataset;
}

$conn->close();
?>

<!-- Variables for use in the HTML section -->
<?php
$workLocations_js = json_encode($locations); 
$mentalHealthDatasets_js = json_encode($datasets);
?>
