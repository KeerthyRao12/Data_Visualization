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

// Fetch Age, Years_of_Experience, and Gender
$query = "SELECT Age, Years_of_Experience, Gender FROM employee_data";
$result = $conn->query($query);

$ageExperienceData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ageExperienceData[] = [
            'age' => $row['Age'],
            'experience' => $row['Years_of_Experience'],
            'gender' => $row['Gender']
        ];
    }
}

// Convert PHP array to JSON
echo "<script>const ageExperienceData = " . json_encode($ageExperienceData) . ";</script>";

$conn->close();
?>
