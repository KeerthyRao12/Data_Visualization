<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$host = 'localhost';
$user = 'root';
$password = 'Sam@1357912';
$dbname = 'ssd_project';
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Drop the procedure if it exists
$sqlDrop = "DROP PROCEDURE IF EXISTS GetActivityImpact;";
if ($conn->query($sqlDrop) !== TRUE) {
    echo "Error dropping procedure: " . $conn->error;
    exit();
}

// Create the procedure
$sqlCreate = "
CREATE PROCEDURE GetActivityImpact()
BEGIN
    SELECT 
        Hours_Studied,
        IFNULL(SUM(CASE WHEN Extracurricular_Activities = 'Yes' THEN Exam_Score ELSE 0 END) / NULLIF(SUM(CASE WHEN Extracurricular_Activities = 'Yes' THEN 1 ELSE 0 END), 0), 0) AS Average_Score_Yes,
        IFNULL(SUM(CASE WHEN Extracurricular_Activities = 'No' THEN Exam_Score ELSE 0 END) / NULLIF(SUM(CASE WHEN Extracurricular_Activities = 'No' THEN 1 ELSE 0 END), 0), 0) AS Average_Score_No
    FROM 
        exam_scores
    GROUP BY 
        Hours_Studied;
END;
";

if ($conn->query($sqlCreate) !== TRUE) {
    echo "Error creating procedure: " . $conn->error;
    exit();
}

// Call the procedure
$callquery = "CALL GetActivityImpact();";
$result = $conn->query($callquery);

if (!$result) {
    echo "Error calling procedure: " . $conn->error;
    exit();
}

// Initialize variables
$hoursStudied = [];
$averageScoresYes = [];
$averageScoresNo = [];

// Fetch the data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hoursStudied[] = $row['Hours_Studied'];
        $averageScoresYes[] = $row['Average_Score_Yes'];
        $averageScoresNo[] = $row['Average_Score_No'];
    }
} else {
    // Handle the case where no rows are returned
    $hoursStudied = [];
    $averageScoresYes = [];
    $averageScoresNo = [];
}

// Close the connection
$conn->close();
?>