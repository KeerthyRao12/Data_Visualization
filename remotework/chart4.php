<?php
// Database connection details
$host = 'localhost';
$user = 'root';
$password = 'Sam@1357912';  
$dbname = 'ssd_project';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch work location and productivity change counts
$sql = "SELECT Work_Location, Productivity_Change, COUNT(*) AS Count
        FROM employee_data
        GROUP BY Work_Location, Productivity_Change";
$result = $conn->query($sql);

// Initialize arrays to store data for Chart.js
$workLocationData = [];
$workLocationLabels = [];
$productivityIncreaseData = [];
$productivityDecreaseData = [];
$productivityNoChangeData = [];

while ($row = $result->fetch_assoc()) {
    $location = $row['Work_Location'];
    $changeType = $row['Productivity_Change'];
    $count = $row['Count'];
    
    if (!in_array($location, $workLocationLabels)) {
        $workLocationLabels[] = $location;
    }
    
    // Fill specific arrays based on productivity change type
    if ($changeType === 'Increase') {
        $workLocationData[$location]['Increase'] = $count;
    } elseif ($changeType === 'Decrease') {
        $workLocationData[$location]['Decrease'] = $count;
    } else {
        $workLocationData[$location]['No Change'] = $count;
    }
}

// Populate arrays for Chart.js, defaulting to 0 if no data for that type
foreach ($workLocationLabels as $location) {
    $productivityIncreaseData[] = $workLocationData[$location]['Increase'] ?? 0;
    $productivityDecreaseData[] = $workLocationData[$location]['Decrease'] ?? 0;
    $productivityNoChangeData[] = $workLocationData[$location]['No Change'] ?? 0;
}

$conn->close();
?>
