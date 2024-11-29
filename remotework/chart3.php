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
$sqlDrop = "DROP PROCEDURE IF EXISTS GetIndustryDistribution;";
if ($conn->query($sqlDrop) !== TRUE) {
    echo "Error dropping procedure: " . $conn->error;
    exit();
}

// Create the procedure
$sqlCreate = "
CREATE PROCEDURE GetIndustryDistribution()
BEGIN
    SELECT
        Industry,
        COUNT(*) AS frequency
    FROM employee_data
    GROUP BY Industry
    ORDER BY frequency DESC;
END;
";
if ($conn->query($sqlCreate) !== TRUE) {
    echo "Error creating procedure: " . $conn->error;
    exit();
}

// Now call the procedure
$callquery = "CALL GetIndustryDistribution();";
$result = $conn->query($callquery);

$industryLabels = [];
$industryData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $industryLabels[] = $row['Industry'];
        $industryData[] = $row['frequency'];
    }
}

// Convert data to JavaScript variables
echo "<script>
    const industryLabels = " . json_encode($industryLabels) . ";
    const industryData = " . json_encode($industryData) . ";
</script>";

$conn->close();
?>
