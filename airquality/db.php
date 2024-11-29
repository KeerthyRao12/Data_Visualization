<?php
$host = '127.0.0.1';
$user = 'root';
$password = '1234'; 
$dbname = 'finaltest'; // Adjust to your database name
$conn = new mysqli($host, $user, $password);
$conn->options(MYSQLI_OPT_LOCAL_INFILE, true);


// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it does not exist
$create_db = "CREATE DATABASE IF NOT EXISTS finaltest";
if ($conn->query($create_db) === TRUE) {
    echo "Database created or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db($dbname);

// Create the `air_quality` table
$sql_create_air_quality_table = "
CREATE TABLE IF NOT EXISTS air_quality (
    ranki INT,
    city VARCHAR(50),
    city_name VARCHAR(50),
    country VARCHAR(50),
    avg INT,
    jan FLOAT,
    feb FLOAT,
    mar FLOAT,
    apr FLOAT,
    may FLOAT,
    jun FLOAT,
    jul FLOAT,
    aug FLOAT,
    sep FLOAT,
    oct FLOAT,
    nov FLOAT,
    dece FLOAT
)";
if ($conn->query($sql_create_air_quality_table) === TRUE) {
    echo "Table 'air_quality' created successfully.<br>";
} else {
    echo "Error creating table 'air_quality': " . $conn->error . "<br>";
}

// Load the CSV data into the `air_quality` table
$load_file = "
LOAD DATA LOCAL INFILE '/opt/lampp/htdocs/Data-V_copy/student_data/aqi.csv'
    INTO TABLE air_quality
    FIELDS TERMINATED BY ',' 
    ENCLOSED BY '\"'
    LINES TERMINATED BY '\\n'
    IGNORE 1 ROWS
    (ranki, city, city_name, country, avg, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece)
";
if ($conn->query($load_file) === TRUE) {
    echo "CSV file loaded successfully!<br>";
} else {
    echo "Error loading CSV file: " . $conn->error . "<br>";
}

// Create the reporting tables
$sql_create_monthly_pollution_for_city = "
CREATE TABLE IF NOT EXISTS monthly_pollution_for_city (
    id INT AUTO_INCREMENT PRIMARY KEY,
    city_name VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL,
    month VARCHAR(20) NOT NULL,
    avg_pollution DECIMAL(10, 2) NOT NULL
)";
if ($conn->query($sql_create_monthly_pollution_for_city) === TRUE) {
    echo "Table 'monthly_pollution_for_city' created successfully.<br>";
    showTableData('monthly_pollution_for_city', $conn);
} else {
    echo "Error creating table 'monthly_pollution_for_city': " . $conn->error . "<br>";
}

$sql_create_top_cities_pollution = "
CREATE TABLE IF NOT EXISTS top_cities_pollution (
    ranki INT,
    city_name VARCHAR(255),
    country VARCHAR(255),
    avg_pollution DECIMAL(10, 2)
)";
if ($conn->query($sql_create_top_cities_pollution) === TRUE) {
    echo "Table 'top_cities_pollution' created successfully.<br>";
    showTableData('top_cities_pollution', $conn);
} else {
    echo "Error creating table 'top_cities_pollution': " . $conn->error . "<br>";
}

$sql_create_worst_pollution_months = "
CREATE TABLE IF NOT EXISTS WorstPollutionMonths (
    City VARCHAR(255),
    WorstMonth VARCHAR(20)
)";
if ($conn->query($sql_create_worst_pollution_months) === TRUE) {
    echo "Table 'WorstPollutionMonths' created successfully.<br>";
    showTableData('WorstPollutionMonths', $conn);
} else {
    echo "Error creating table 'WorstPollutionMonths': " . $conn->error . "<br>";
}

// Create the `generate_monthly_pollution_for_city_report` procedure
$sql_create_procedure_monthly_pollution = "
CREATE PROCEDURE generate_monthly_pollution_for_city_report()
BEGIN
    TRUNCATE TABLE monthly_pollution_for_city;
    INSERT INTO monthly_pollution_for_city (city_name, country, month, avg_pollution)
    SELECT city_name, country, 'Jan', jan FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Feb', feb FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Mar', mar FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Apr', apr FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'May', may FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Jun', jun FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Jul', jul FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Aug', aug FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Sep', sep FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Oct', oct FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Nov', nov FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Dec', dece FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow');
END";
if ($conn->query($sql_create_procedure_monthly_pollution) === TRUE) {
    echo "Stored procedure 'generate_monthly_pollution_for_city_report' created successfully.<br>";
    $conn->query("CALL generate_monthly_pollution_for_city_report()");
    echo "Procedure executed successfully.<br>";
    showTableData('monthly_pollution_for_city', $conn);
} else {
    echo "Error creating procedure 'generate_monthly_pollution_for_city_report': " . $conn->error . "<br>";
}

// Create the `generate_top_cities_pollution_report` procedure
$sql_create_procedure_top_cities_pollution = "
CREATE PROCEDURE generate_top_cities_pollution_report()
BEGIN
    TRUNCATE TABLE top_cities_pollution;
    INSERT INTO top_cities_pollution (ranki, city_name, country, avg_pollution)
    SELECT ranki, city_name, country, avg
    FROM air_quality
    ORDER BY avg DESC
    LIMIT 50;
END";
if ($conn->query($sql_create_procedure_top_cities_pollution) === TRUE) {
    echo "Stored procedure 'generate_top_cities_pollution_report' created successfully.<br>";
    $conn->query("CALL generate_top_cities_pollution_report()");
    echo "Procedure executed successfully.<br>";
    showTableData('top_cities_pollution', $conn);
} else {
    echo "Error creating procedure 'generate_top_cities_pollution_report': " . $conn->error . "<br>";
}

// Create the `GetWorstPollutionMonthPerCity` procedure
$sql_create_procedure_worst_pollution_months = "
CREATE PROCEDURE GetWorstPollutionMonthPerCity()
BEGIN
    TRUNCATE TABLE WorstPollutionMonths;
    INSERT INTO WorstPollutionMonths (City, WorstMonth)
    WITH CityWorstMonth AS (
        SELECT 
            city,
            CASE 
                WHEN jan = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'January'
                WHEN feb = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'February'
                WHEN mar = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'March'
                WHEN apr = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'April'
                WHEN may = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'May'
                WHEN jun = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'June'
                WHEN jul = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'July'
                WHEN aug = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'August'
                WHEN sep = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'September'
                WHEN oct = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'October'
                WHEN nov = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'November'
                ELSE 'December'
            END AS WorstMonth
        FROM air_quality
    )
    SELECT city, WorstMonth FROM CityWorstMonth;
END";
if ($conn->query($sql_create_procedure_worst_pollution_months) === TRUE) {
    echo "Stored procedure 'GetWorstPollutionMonthPerCity' created successfully.<br>";
    $conn->query("CALL GetWorstPollutionMonthPerCity()");
    echo "Procedure executed successfully.<br>";
    showTableData('WorstPollutionMonths', $conn);
} else {
    echo "Error creating procedure 'GetWorstPollutionMonthPerCity': " . $conn->error . "<br>";
}

// Function to display table data
function showTableData($table_name, $conn) {
    $result = $conn->query("SELECT * FROM $table_name");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<pre>";
            print_r($row);
            echo "</pre>";
        }
    } else {
        echo "No data found in $table_name.<br>";
    }
}

// Close the connection
$conn->close();
?>
