<?php
                        // Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    // Database connection
    $conn = new mysqli('localhost', 'root', 'Sam@1357912', 'ssd_project');

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Drop the procedure if it exists
    $sqlDrop = "DROP PROCEDURE IF EXISTS GetDetailedExamPerformanceBySchoolType";
    if (!$conn->query($sqlDrop)) {
        throw new Exception("Error dropping procedure: " . $conn->error);
    }

    // Create an enhanced procedure
    $sqlCreate = "
    CREATE PROCEDURE GetDetailedExamPerformanceBySchoolType()
    BEGIN
        SELECT 
            School_Type, 
            ROUND(AVG(Exam_Score), 2) AS Average_Score,
            ROUND(MIN(Exam_Score), 2) AS Min_Score,
            ROUND(MAX(Exam_Score), 2) AS Max_Score,
            ROUND(STDDEV(Exam_Score), 2) AS Score_Deviation,
            COUNT(Exam_Score) AS Score_Count,
            ROUND(AVG(CASE WHEN Exam_Score >= 90 THEN 1 ELSE 0 END) * 100, 2) AS High_Performers_Percentage
        FROM 
               exam_scores
        GROUP BY 
            School_Type;
    END";
                            
    if (!$conn->query($sqlCreate)) {
        throw new Exception("Error creating procedure: " . $conn->error);
    }

                            // Call the procedure
    $result = $conn->query("CALL GetDetailedExamPerformanceBySchoolType()");

    if (!$result) {
        throw new Exception("Error calling procedure: " . $conn->error);
    }

        $schoolTypes = [];
        $performanceData = [];

        // Fetch the data
        while ($row = $result->fetch_assoc()) {
            $schoolTypes[] = $row['School_Type'];
            $performanceData[] = $row;
        }

        // Free result set
        $result->free();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            exit();
        } finally {
        // Close the connection
        if (isset($conn)) {
            $conn->close();
        }
    }
?>