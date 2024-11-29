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
$sqlDrop = "DROP PROCEDURE IF EXISTS GetEmployeeAgeRange;";
if ($conn->query($sqlDrop) !== TRUE) {
    echo "Error dropping procedure: " . $conn->error;
    exit();
}

// Create the procedure
$sqlCreate = "
CREATE PROCEDURE GetEmployeeAgeRange()
BEGIN
    SELECT
        CASE
            WHEN Age BETWEEN 20 AND 29 THEN '20-29'
            WHEN Age BETWEEN 30 AND 39 THEN '30-39'
            WHEN Age BETWEEN 40 AND 49 THEN '40-49'
            WHEN Age BETWEEN 50 AND 59 THEN '50-59'
            WHEN Age >= 60 THEN '60+'
        END AS age_range,
        COUNT(*) AS frequency
    FROM employee_data
    GROUP BY age_range
    ORDER BY age_range;
END;
";
if ($conn->query($sqlCreate) !== TRUE) {
    echo "Error creating procedure: " . $conn->error;
    exit();
}

// Now call the procedure
$callquery = "CALL GetEmployeeAgeRange();";
$result = $conn->query($callquery);

$ages1 = [];
$frequencies1 = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ages1[] = $row['age_range'];
        $frequencies1[] = $row['frequency'];
    }
}

// Convert data to JavaScript variables
echo "<script>
    const ageLabels = " . json_encode($ages1) . ";
    const ageData = " . json_encode($frequencies1) . ";
</script>";

$conn->close();
?>
