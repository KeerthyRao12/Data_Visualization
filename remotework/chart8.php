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

// Query to get the age and experience data
$query = "
    SELECT 
        CASE
            WHEN Age BETWEEN 20 AND 29 THEN '20-29'
            WHEN Age BETWEEN 30 AND 39 THEN '30-39'
            WHEN Age BETWEEN 40 AND 49 THEN '40-49'
            WHEN Age BETWEEN 50 AND 59 THEN '50-59'
            WHEN Age BETWEEN 60 AND 69 THEN '60-69'
        END AS Age_Group,
        CASE
            WHEN Years_of_Experience BETWEEN 0 AND 5 THEN '0-5'
            WHEN Years_of_Experience BETWEEN 6 AND 10 THEN '6-10'
            WHEN Years_of_Experience BETWEEN 11 AND 20 THEN '11-20'
            WHEN Years_of_Experience BETWEEN 21 AND 30 THEN '21-30'
            WHEN Years_of_Experience BETWEEN 31 AND 40 THEN '31-40'
        END AS Experience_Group,
        COUNT(*) AS Employee_Count
    FROM employee_data
    GROUP BY Age_Group, Experience_Group
    ORDER BY Age_Group, Experience_Group;
";

$result = $conn->query($query);

// Define static groups for age and experience
$ageGroups8 = ['20-29', '30-39', '40-49', '50-59', '60-69'];
$experienceGroups = ['0-5', '6-10', '11-20', '21-30', '31-40'];

// Initialize an empty array to store counts, filled with zeros initially
$counts = array_fill(0, count($ageGroups8), array_fill(0, count($experienceGroups), 0));

// Fetch data and fill the counts array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Check if the row contains valid data for both Age_Group and Experience_Group
        $ageIndex = array_search($row['Age_Group'], $ageGroups8);
        $experienceIndex = array_search($row['Experience_Group'], $experienceGroups);
        
        if ($ageIndex !== false && $experienceIndex !== false) {
            $counts[$ageIndex][$experienceIndex] = (int) $row['Employee_Count'];
        }
    }
}

// Prepare the data for Chart.js
$ageGroupsJSON = json_encode($ageGroups8);
$experienceGroupsJSON = json_encode($experienceGroups);
$countsJSON = json_encode($counts);

$conn->close();
?>
