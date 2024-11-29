<?php
$host = 'localhost';
$user = 'root';
$password = 'Sam@1357912'; 
$dbname = 'ssd_project';
$conn = new mysqli($host, $user, $password);

$file_path = '/var/lib/mysql-files/StudentPerformanceFactors.csv';  


// echo "HEHEHEEHHEEHE";
// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to create the database if it does not exist
$create_db = "CREATE DATABASE IF NOT EXISTS ssd_project";

// Execute the query
if ($conn->query($create_db) === TRUE) {
    // echo "Database created or already exists.";
} else {
    echo "Error creating database: " . $conn->error;
}


$conn->query("SET GLOBAL local_infile = 1");

// Select the database
$conn->select_db($dbname);
$conn->options(MYSQLI_OPT_LOCAL_INFILE, true);

// SQL query to create the employee_data table
$sql_create_table = "
CREATE TABLE IF NOT EXISTS exam_scores (
    Hours_Studied INT,
    Attendance INT,
    Parental_Involvement VARCHAR(10),
    Access_to_Resources VARCHAR(10),
    Extracurricular_Activities VARCHAR(5),
    Sleep_Hours INT,
    Previous_Scores INT,
    Motivation_Level VARCHAR(10),
    Internet_Access VARCHAR(5),
    Tutoring_Sessions INT,
    Family_Income VARCHAR(10),
    Teacher_Quality VARCHAR(10),
    School_Type VARCHAR(10),
    Peer_Influence VARCHAR(10),
    Physical_Activity INT,
    Learning_Disabilities VARCHAR(5),
    Parental_Education_Level VARCHAR(15),
    Distance_from_Home VARCHAR(10),
    Gender VARCHAR(10),
    Exam_Score INT
);
";

// Execute the query to create the table
if ($conn->query($sql_create_table) === TRUE) {
    // echo "Table 'employee_data' created successfully.\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}




// Close the connection
$conn->close();
?>
