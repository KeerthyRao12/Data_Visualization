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
$sqlDrop = "DROP PROCEDURE IF EXISTS GetMentalHealthByJobRole;";
if ($conn->query($sqlDrop) !== TRUE) {
    echo "Error dropping procedure: " . $conn->error;
    exit();
}

// Create the procedure
$sqlCreate = "
CREATE PROCEDURE GetMentalHealthByJobRole()
BEGIN
    SELECT 
        Job_Role,
        Mental_Health_Condition,
        COUNT(*) AS frequency
    FROM employee_data
    WHERE Mental_Health_Condition != 'None'  
    GROUP BY Job_Role, Mental_Health_Condition
    ORDER BY Job_Role, Mental_Health_Condition;
END;

";
if ($conn->query($sqlCreate) !== TRUE) {
    echo "Error creating procedure: " . $conn->error;
    exit();
}

// Now call the procedure
$callquery = "CALL GetMentalHealthByJobRole();";
$result = $conn->query($callquery);

$jobRoles5 = [];
$mentalHealthData5 = [];

// Format data for Chart.js
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jobRole5 = $row['Job_Role'];
        $condition5 = $row['Mental_Health_Condition'];
        $frequency5 = (int)$row['frequency'];
        
        // Add data to arrays
        if (!isset($mentalHealthData5[$jobRole5])) {
            $mentalHealthData5[$jobRole5] = [];
        }
        $mentalHealthData5[$jobRole5][$condition5] = $frequency5;
    }
}

// Close the database connection
$conn->close();

// Convert data to JavaScript variables
echo "<script>
    const jobRoles = " . json_encode(array_keys($mentalHealthData5)) . ";
    const conditionsData = " . json_encode($mentalHealthData5) . ";
</script>";
?>
