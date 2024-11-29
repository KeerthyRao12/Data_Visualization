<?php
$host = 'localhost';
$user = 'root';
$password = 'Sam@1357912'; 
$dbname = 'ssd_project';
$conn = $conn = new mysqli($host, $user, $password);

$file_path = 'D:\xampp\htdocs\SSD_Project\datasets\commodity.csv';  

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
CREATE TABLE IF NOT EXISTS prices_commodities(
State varchar(30),
District varchar(35), 
Market varchar(35),
Commodity varchar(40), 
Variety varchar(30),
Grade varchar(10),
Min_Price int,
Max_Price int, 
Modal_Price int
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
    INTO TABLE prices_commodities
    FIELDS TERMINATED BY ','
    ENCLOSED BY '\"'
    LINES TERMINATED BY '\\n'
    IGNORE 1 LINES
    (State,District,Market,Commodity,Variety,Grade,Min_Price,Max_Price,Modal_Price)


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
