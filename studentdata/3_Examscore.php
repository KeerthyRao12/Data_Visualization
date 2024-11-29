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

// Fetch Exam Scores
$sql = "SELECT Exam_Score FROM exam_scores";
$result = $conn->query($sql);

// Prepare data for the chart
$exam_scores = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $exam_scores[] = $row['Exam_Score'];
    }
} else {
    echo "No results found.";
}

// Close the connection
$conn->close();

// Calculate frequency of each exam score
$score_frequency = array_count_values($exam_scores);
$max_score = max($exam_scores); // Maximum score in the dataset (adjust accordingly)
?>
