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
$sqlDrop = "DROP PROCEDURE IF EXISTS GetPartyResultsByState;";
if ($conn->query($sqlDrop) !== TRUE) {
    echo "Error dropping procedure: " . $conn->error;
    exit();
}

// Create the procedure with the updated query (only counting wins)
$sqlCreate = "
CREATE PROCEDURE GetPartyResultsByState()
BEGIN
    SELECT 
        State,
        Party,
        SUM(CASE WHEN Result = 'Won' THEN 1 ELSE 0 END) AS Wins
    FROM 
        ElectionResults
    GROUP BY 
        State, Party;
END;
";
if ($conn->query($sqlCreate) !== TRUE) {
    echo "Error creating procedure: " . $conn->error;
    exit();
}

// Call the procedure
$callquery = "CALL GetPartyResultsByState();";
$result = $conn->query($callquery);

if (!$result) {
    echo "Error calling procedure: " . $conn->error;
    exit();
}

$stateLabels = [];
$partyLabels = [];
$winsData = [];

// Fetch the data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stateLabels[] = $row['State'];
        $partyLabels[] = $row['Party'];
        $winsData[] = $row['Wins'];
    }
} else {
    echo "No results found.";
}

// Close the connection
$conn->close();
?>
