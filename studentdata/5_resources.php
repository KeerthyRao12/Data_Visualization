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
$sqlDrop = "DROP PROCEDURE IF EXISTS GetRadarChartData;";
if ($conn->query($sqlDrop) !== TRUE) {
    echo "Error dropping procedure: " . $conn->error;
    exit();
}

// Create the procedure
$sqlCreate = "
CREATE PROCEDURE GetRadarChartData()
BEGIN
    WITH Quartiles AS (
        SELECT 
            Exam_Score,
            NTILE(4) OVER (ORDER BY Exam_Score) AS Quartile
        FROM 
            exam_scores
    )
    SELECT 
        Q.Quartile,
        AVG(E.Hours_Studied) AS Avg_Hours_Studied,
        AVG(E.Attendance) AS Avg_Attendance,
        AVG(E.Sleep_Hours) AS Avg_Sleep_Hours,
        AVG(E.Parental_Involvement) AS Avg_Parental_Involvement
    FROM 
        Quartiles Q
    JOIN 
        exam_scores E
    ON 
        Q.Exam_Score = E.Exam_Score
    GROUP BY 
        Q.Quartile
    ORDER BY 
        Q.Quartile;
END;
";

if ($conn->query($sqlCreate) !== TRUE) {
    echo "Error creating procedure: " . $conn->error;
    exit();
}

// Call the procedure
$callquery = "CALL GetRadarChartData();";
$result = $conn->query($callquery);

if (!$result) {
    echo "Error calling procedure: " . $conn->error;
    exit();
}

// Initialize variables
$quartiles = [];
$avgHoursStudied = [];
$avgAttendance = [];
$avgSleepHours = [];
$avgParentalInvolvement = [];

// Fetch the data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $quartiles[] = $row['Quartile'];
        $avgHoursStudied[] = $row['Avg_Hours_Studied'];
        $avgAttendance[] = $row['Avg_Attendance'];
        $avgSleepHours[] = $row['Avg_Sleep_Hours'];
        $avgParentalInvolvement[] = $row['Avg_Parental_Involvement'];
    }
} else {
    // Handle the case where no rows are returned
    $quartiles = [];
    $avgHoursStudied = [];
    $avgAttendance = [];
    $avgSleepHours = [];
    $avgParentalInvolvement = [];
}

// Close the connection
$conn->close();
?>
