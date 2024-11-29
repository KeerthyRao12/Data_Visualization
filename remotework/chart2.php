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
$sqlDrop = "DROP PROCEDURE IF EXISTS GetJobRoleDistribution;";
if ($conn->query($sqlDrop) !== TRUE) {
    echo "Error dropping procedure: " . $conn->error;
    exit();
}

// Create the procedure
$sqlCreate = "
CREATE PROCEDURE GetJobRoleDistribution()
BEGIN
    SELECT Job_Role AS job_role, COUNT(*) AS frequency
    FROM employee_data
    GROUP BY Job_Role
    ORDER BY frequency DESC;
END;
";
if ($conn->query($sqlCreate) !== TRUE) {
    echo "Error creating procedure: " . $conn->error;
    exit();
}

// Now call the procedure
$callquery = "CALL GetJobRoleDistribution();";
$result = $conn->query($callquery);

$jobRoles2 = [];
$frequencies2 = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jobRoles2[] = $row['job_role'];
        $frequencies2[] = $row['frequency'];
    }
}

// Convert data to JavaScript variables
echo "<script>
    const jobRoleLabels = " . json_encode($jobRoles2) . ";
    const jobRoleData = " . json_encode($frequencies2) . ";
</script>";

$conn->close();
?>
