<?php
$host = 'localhost';
$user = 'root';
$password = 'Sam@1357912'; 
$dbname = 'ssd_project';
$conn = $conn = new mysqli($host, $user, $password);

$file_path = 'D:\xampp\htdocs\SSD_Project\datasets\Impact_of_Remote_Work_on_Mental_Health.csv';  

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
CREATE TABLE IF NOT EXISTS ElectionResults (
    State VARCHAR(100),
    Constituency VARCHAR(100),
    Candidate VARCHAR(100),
    Party VARCHAR(100),
    EVM_Votes INT,
    Postal_Votes INT,
    Total_Votes INT,
    Vote_Percentage DECIMAL(5, 2),
    Result VARCHAR(10)
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
