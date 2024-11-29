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

// Drop the procedure if it exists
$sqlDrop = "DROP PROCEDURE IF EXISTS GetMeanAgeByRoleIndustry;";
if ($conn->query($sqlDrop) !== TRUE) {
    echo "Error dropping procedure: " . $conn->error;
    exit();
}

// Create the procedure to calculate mean age by job role and industry
$sqlCreate = "
CREATE PROCEDURE GetMeanAgeByRoleIndustry()
BEGIN
    SELECT
        Job_Role,
        Industry,
        AVG(Age) AS mean_age
    FROM employee_data
    GROUP BY Job_Role, Industry
    ORDER BY Job_Role, Industry;
END;
";
if ($conn->query($sqlCreate) !== TRUE) {
    echo "Error creating procedure: " . $conn->error;
    exit();
}

// Call the procedure
$callquery = "CALL GetMeanAgeByRoleIndustry();";
$result = $conn->query($callquery);

$jobRoles6 = [];
$industries6 = [];
$meanAges6 = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jobRoles6[] = $row['Job_Role'];
        $industries6[] = $row['Industry'];
        $meanAges6[] = (float)$row['mean_age']; // Ensure to handle the mean age as a float
    }
}

// Convert data to JavaScript variables for Chart.js
echo "<script>
    const jobRoles6 = " . json_encode($jobRoles6) . ";
    const industries6 = " . json_encode($industries6) . ";
    const meanAges6 = " . json_encode($meanAges6) . ";
</script>";

$conn->close();
?>
