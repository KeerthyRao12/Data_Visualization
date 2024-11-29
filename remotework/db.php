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
CREATE TABLE IF NOT EXISTS employee_data (
    Employee_ID VARCHAR(10) PRIMARY KEY,
    Age INT,
    Gender VARCHAR(50),
    Job_Role VARCHAR(50),
    Industry VARCHAR(50),
    Years_of_Experience INT,
    Work_Location VARCHAR(50),
    Hours_Worked_Per_Week INT,
    Number_of_Virtual_Meetings INT,
    Work_Life_Balance_Rating INT,
    Stress_Level VARCHAR(50),
    Mental_Health_Condition VARCHAR(50),
    Access_to_Mental_Health_Resources VARCHAR(10),
    Productivity_Change VARCHAR(50),
    Social_Isolation_Rating INT,
    Satisfaction_with_Remote_Work VARCHAR(50),
    Company_Support_for_Remote_Work INT,
    Physical_Activity VARCHAR(50),
    Sleep_Quality VARCHAR(50),
    Region VARCHAR(50)
);
";

// Execute the query to create the table
if ($conn->query($sql_create_table) === TRUE) {
    // echo "Table 'employee_data' created successfully.\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}



$load_file = "
LOAD DATA LOCAL INFILE '" . $conn->real_escape_string($file_path) . "'
    INTO TABLE employee_data
    FIELDS TERMINATED BY ','
    ENCLOSED BY '\"'
    LINES TERMINATED BY '\\n'
    IGNORE 1 LINES
    (Employee_ID,Age,Gender,Job_Role,Industry,Years_of_Experience,Work_Location,Hours_Worked_Per_Week,Number_of_Virtual_Meetings,Work_Life_Balance_Rating,Stress_Level,Mental_Health_Condition,Access_to_Mental_Health_Resources,Productivity_Change,Social_Isolation_Rating,Satisfaction_with_Remote_Work,Company_Support_for_Remote_Work,Physical_Activity,Sleep_Quality,Region)


";

// Execute the query
if ($conn->query($load_file) === TRUE) {
    // echo "CSV file loaded successfully!";
} else {
    echo "Error loading CSV file: " . $conn->error;
}



// Close the connection
$conn->close();
?>
