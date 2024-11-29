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
$sqlDrop = "DROP PROCEDURE IF EXISTS GetAverageScores;";
if ($conn->query($sqlDrop) !== TRUE) {
    echo "Error dropping procedure: " . $conn->error;
    exit();
}

// Create the procedure
$sqlCreate = "
CREATE PROCEDURE GetAverageScores()
BEGIN
    SELECT 
        Hours_Studied, 
        AVG(Exam_Score) AS Average_Score
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
$callquery = "CALL GetAverageScores();";
$result = $conn->query($callquery);

if (!$result) {
    echo "Error calling procedure: " . $conn->error;
    exit();
}

$hoursStudied = [];
$averageScores = [];

// Fetch the data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hoursStudied[] = $row['Hours_Studied'];
        $averageScores[] = $row['Average_Score'];
    }
} else {
    echo "No results found.";
}

// Close the connection
$conn->close();
?>
