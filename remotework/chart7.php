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

// Get the work location from the POST request
$location = $_POST['location'] ?? 'Remote';

// Query to group workers by age group for the selected location
$query = "
    SELECT 
        CASE
            WHEN Age BETWEEN 18 AND 24 THEN '18-24'
            WHEN Age BETWEEN 25 AND 34 THEN '25-34'
            WHEN Age BETWEEN 35 AND 44 THEN '35-44'
            WHEN Age BETWEEN 45 AND 54 THEN '45-54'
            WHEN Age BETWEEN 55 AND 64 THEN '55-64'
            ELSE '65+'
        END AS Age_Group,
        COUNT(*) AS Worker_Count
    FROM employee_data
    WHERE Work_Location = ?
    GROUP BY Age_Group
    ORDER BY Age_Group;
";

$stmt = $conn->prepare($query);
$stmt->bind_param('s', $location);
$stmt->execute();
$result = $stmt->get_result();

$ageGroups = [];
$workCounts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ageGroups[] = $row['Age_Group'];
        $workCounts[] = (int) $row['Worker_Count'];
    }
}

// If no results, provide default empty data
if (empty($ageGroups)) {
    $ageGroups = ['No Data'];
    $workCounts = [0];
}

// Normalize the work counts
$min = min($workCounts);
$max = max($workCounts);
$normalizedCounts = ($min === $max) 
    ? array_fill(0, count($workCounts), 1) // Handle case where all values are the same
    : array_map(function($count) use ($min, $max) {
        return ($count - $min) / ($max - $min);
    }, $workCounts);

// Generate colors based on the normalized counts
$baseColor = [0, 128, 128]; // Teal base color (R, G, B)
$colors = array_map(function($norm) use ($baseColor) {
    $color = array_map(function($base) use ($norm) {
        return round($base + (255 - $base) * (1 - $norm));
    }, $baseColor);
    return "rgba(" . implode(", ", $color) . ", 0.8)";
}, $normalizedCounts);

// Generate a summary based on the selected location
$summary = match (strtolower($location)) {
    'remote' => 'Remote: Employees aged 25-34 and 45-54 are significantly more likely to work remotely compared to other age groups.',
    'hybrid' => 'Hybrid: Workers aged 25-34	 prefer hybrid arrangements compared to other age groups.',
    'onsite' => 'Onsite: Onsite work is more common among employees aged 45-54 and 25-34.',
    default => 'No data available for the selected work location.',
};

// Output the data as JSON for AJAX
header('Content-Type: application/json');
echo json_encode([
    'ageGroups' => $ageGroups,
    'workCounts' => $workCounts,
    'colors' => $colors,
    'summary' => $summary
]);

$conn->close();
?>
