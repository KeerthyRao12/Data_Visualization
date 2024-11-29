<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/plotly.js-dist@2.16.1/plotly.min.js"></script> <!-- Plotly.js CDN -->

    <!-- Include the Chart.js Boxplot Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-boxplot"></script>
    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Student Data</title>

    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa; /* Light background for better contrast */
            color: #343a40; /* Dark text for readability */
        }

        /* Card Styles */
        .card {
            margin-bottom: 20px;
            border: 1px solid #dee2e6; /* Light border for cards */
            border-radius: 0.5rem; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .card-body {
            padding: 20px; /* Increased padding for better spacing */
        }

        /* Button Styles */
        .btn-custom {
            background-color: #007bff; /* Primary color */
            color: white;
            border: none; /* Remove border */
            border-radius: 0.25rem; /* Rounded corners */
        }

        .btn-custom:hover {
            background-color: #0056b3; /* Darker shade on hover */
            transition: background-color 0.3s; /* Smooth transition */
        }

        /* Table Styles */
        .table th, .table td {
            vertical-align: middle; /* Center align content */
            padding: 12px; /* Increased padding for table cells */
        }

        .table-dark {
            background-color: #343a40; /* Dark background for table header */
            color: white; /* White text for contrast */
        }

        /* Accordion Styles */
        .accordion-button {
            background-color: #e2e6ea; /* Light background for accordion buttons */
            color: #343a40; /* Dark text */
            border: 1px solid #ced4da; /* Border for accordion buttons */
        }

        .accordion-button:not(.collapsed) {
            background-color: #d1d3e0; /* Slightly darker when expanded */
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                padding: 0 15px; /* Add padding for smaller screens */
            }
        }
    </style>
</head>

<body>
    <!-- Container for the Content -->
    <div class="container my-5">
        <h1 class="text-center mb-4">Student Performance factors</h1>

        <h3 class="mb-3">About the Dataset</h3>
        <p class="mb-4">
            Student performance is influenced by a variety of factors, both intrinsic and extrinsic. These factors are often interconnected and play a significant role in shaping academic outcomes. Student performance is shaped by a complex interplay of intrinsic and extrinsic factors, each contributing uniquely to academic success. These factors are deeply interconnected, influencing not only a student’s ability to learn but also their overall development and well-being. Understanding these elements is crucial for identifying opportunities to foster growth and improve educational outcomes.        </p>

        <p class="mb-4">
            With 6,610 records from employees worldwide, this dataset offers valuable insights into key factors such as work location (remote, hybrid, onsite), stress levels, access to mental health resources, and job satisfaction. It is designed to support researchers, HR professionals, and businesses in evaluating the growing impact of remote work on employee well-being and productivity. 📚📊
        </p>

        <h3 class="mb-3">Dataset Columns:</h3>
        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Hours_Studied:</strong> The number of hours the student spends studying daily.</li>
            <li class="list-group-item"><strong>Attendance:</strong> The percentage of classes attended by the student.</li>
            <li class="list-group-item"><strong>Parental_Involvement:</strong> The level of parental participation in the student's academic activities.</li>
            <li class="list-group-item"><strong>Access_to_Resources:</strong> Availability of educational resources like books, computers, or the internet.</li>
            <li class="list-group-item"><strong>Extracurricular_Activities:</strong> Participation in activities like sports, music, or clubs outside academics.</li>
            <li class="list-group-item"><strong>Sleep_Hours:</strong> The average number of hours the student sleeps per day.</li>
            <li class="list-group-item"><strong>Previous_Scores:</strong> Scores obtained by the student in earlier exams or assessments.</li>
            <li class="list-group-item"><strong>Motivation_Level:</strong> The student's self-reported motivation towards studies.</li>
            <li class="list-group-item"><strong>Internet_Access:</strong> Availability of a stable internet connection for academic use.</li>
            <li class="list-group-item"><strong>Tutoring_Sessions:</strong> The number of tutoring sessions attended by the student.</li>
            <li class="list-group-item"><strong>Family_Income:</strong> The household income level, which may influence access to resources.</li>
            <li class="list-group-item"><strong>Teacher_Quality:</strong> The perceived quality and effectiveness of teachers.</li>
            <li class="list-group-item"><strong>School_Type:</strong> The type of school the student attends (public, private, or home-schooled).</li>
            <li class="list-group-item"><strong>Peer_Influence:</strong> The influence of friends or classmates on the student's behavior and performance.</li>
            <li class="list-group-item"><strong>Physical_Activity:</strong> The level of physical activity the student engages in regularly.</li>
            <li class="list-group-item"><strong>Learning_Disabilities:</strong> Any diagnosed learning disabilities, such as dyslexia or ADHD.</li>
            <li class="list-group-item"><strong>Parental_Education_Level:</strong> The highest education level achieved by the student's parents.</li>
            <li class="list-group-item"><strong>Distance_from_Home:</strong> The distance between the student's home and their school.</li>
            <li class="list-group-item"><strong>Gender:</strong> The gender of the student (e.g., Male, Female, Non-binary).</li>
            <li class="list-group-item"><strong>Exam_Score:</strong> The score achieved by the student in the most recent exam.</li>
        </ul>

    </div>



    <div class="container my-5 text-center">
        <button id="toggleButton" class="btn btn-secondary btn-sm mb-3">Show sample</button>

        <div class="table-responsive" id="tableContainer" style="display: none;">
            <table class="table table-bordered table-striped table-sm">
                <thead class="table-dark">
                    <tr>
                        <th class="p-3">Hours_Studied</th>
                        <th class="p-3">Attendance</th>
                        <th class="p-3">Parental_Involvement</th>
                        <th class="p-3">Access_to_Resources</th>
                        <th class="p-3">Extracurricular_Activities</th>
                        <th class="p-3">Sleep_Hours</th>
                        <th class="p-3">Previous_Scores</th>
                        <th class="p-3">Motivation_Level</th>
                        <th class="p-3">Internet_Access</th>
                        <th class="p-3">Tutoring_Sessions</th>
                        <th class="p-3">Family_Income</th>
                        <th class="p-3">Teacher_Quality</th>
                        <th class="p-3">School_Type</th>
                        <th class="p-3">Peer_Influence</th>
                        <th class="p-3">Physical_Activity</th>
                        <th class="p-3">Learning_Disabilities</th>
                        <th class="p-3">Parental_Education_Level</th>
                        <th class="p-3">Distance_from_Home</th>
                        <th class="p-3">Gender</th>
                        <th class="p-3">Exam_Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $host = 'localhost';
                    $user = 'root';
                    $password = 'Sam@1357912';
                    $dbname = 'ssd_project';
                    $conn = new mysqli($host, $user, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sample = "SELECT * FROM exam_scores LIMIT 5;";
                    $rs = mysqli_query($conn, $sample);

                    if ($rs->num_rows > 0) {
                        while ($row = $rs->fetch_assoc()) {
                    ?>
                            <tr>
                               <td class="text-center p-3"><?php echo $row['Hours_Studied']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Attendance']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Parental_Involvement']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Access_to_Resources']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Extracurricular_Activities']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Sleep_Hours']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Previous_Scores']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Motivation_Level']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Internet_Access']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Tutoring_Sessions']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Family_Income']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Teacher_Quality']; ?></td>
                                <td class="text-center p-3"><?php echo $row['School_Type']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Peer_Influence']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Physical_Activity']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Learning_Disabilities']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Parental_Education_Level']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Distance_from_Home']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Gender']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Exam_Score']; ?></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='20' class='text-center'>No records found</td></tr>";
                    }

                    $conn->close();

                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container my-5">
        <center>
            <h2>Data Visualization</h2>
        </center>
    </div>


    <!-- ********************** *******   chart 1 **************************************************** -->
    
<div class="accordion container my-5" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseChart" aria-expanded="false" aria-controls="collapseChart">
                Chart 1: Average Exam Score by Extracurricular Activities 
            </button>
        </h2>
        <div id="collapseChart" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <?php
                // Include the PHP file that fetches exam score data
                include '1_Extracurricular.php'; // Sets $hoursStudied, $averageScoresYes, $averageScoresNo
                ?>
                <div class="container my-2">
                    <div class="row">
                        <!-- Left column for the table -->
                        <div class="col-md-5">
                            <div class="table-responsive overflow-auto" style="max-height: 300px;">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Hours Studied</th>
                                            <th>Extracurricular Activities (Yes)</th>
                                            <th>Extracurricular Activities (No)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Check if data arrays are not empty before rendering the table
                                        if (!empty($hoursStudied)) {
                                            for ($i = 0; $i < count($hoursStudied); $i++) {
                                                echo "<tr>
                                                    <td>{$hoursStudied[$i]}</td>
                                                    <td>{$averageScoresYes[$i]}</td>
                                                    <td>{$averageScoresNo[$i]}</td>
                                                </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='3'>No data available</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Right column for the chart -->
                        <div class="col-md-7">
                            <canvas id="stackedBarChart" width="1000" height="400"></canvas>
                        </div>
                    </div>
                    <pre>This stacked bar chart shows the average exam scores grouped by hours studied and participation in extracurricular activities.</pre>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ************************************ chart 2 ********************************************** -->
 <div class="container my-5">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseChart" aria-expanded="false" aria-controls="collapseChart">
                        Chart 2: Average Exam Score by School Type
                    </button>
                </h2>
                <div id="collapseChart" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php
                        // Include the PHP file that fetches exam score data
                        include '2_schooltype.php'; // Sets $hoursStudied, $averageScoresYes, $averageScoresNo
                        ?>
                        
                        <div class="container my-2">
                            <!-- Performance Summary -->
                            <div class="performance-summary">
                                <h5>Performance Overview</h5>
                                <div class="row">
                                    <?php
                                    foreach ($performanceData as $data) {
                                        echo "<div class='col-md-4 mb-2'>
                                            <strong>{$data['School_Type']} Schools:</strong>
                                            Avg Score: {$data['Average_Score']} 
                                            (Range: {$data['Min_Score']} - {$data['Max_Score']})
                                        </div>";
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Left column for the table -->
                                <div class="col-md-5">
                                    <div class="table-responsive overflow-auto" style="max-height: 400px;">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th>School Type</th>
                                                    <th>Avg Score</th>
                                                    <th>Min Score</th>
                                                    <th>Max Score</th>
                                                    <th>Score Count</th>
                                                    <th>Score Deviation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($performanceData as $data) {
                                                    echo "<tr>
                                                        <td>{$data['School_Type']}</td>
                                                        <td>{$data['Average_Score']}</td>
                                                        <td>{$data['Min_Score']}</td>
                                                        <td>{$data['Max_Score']}</td>
                                                        <td>{$data['Score_Count']}</td>
                                                        <td>{$data['Score_Deviation']}</td>
                                                    </tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Right column for the chart -->
                                <div class="col-md-7">
                                    <canvas id="schoolTypePerformanceChart" width="1000" height="400"></canvas>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <h6>Analysis Notes:</h6>
                                <p class="text-muted">
                                    This visualization compares exam performance across different school types. 
                                    The chart shows average scores, while the table provides detailed statistical insights.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ******************************   chart 3 **************************************************** -->
    
    <div class="accordion container my-5" id="accordionExample">
<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            Chart 3: Distribution of Exam Scores
        </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <?php
            // Include the PHP file that fetches exam scores data
            include '3_Examscore.php'; // This should set $exam_scores and $score_frequency
            ?>
            <div class="container my-2">
                <div class="row">
                    <!-- Left column for the table -->
                    <div class="col-md-6">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Exam Score</th>
                                        <th>Frequency</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Display the data in the table (Exam Scores and their Frequencies)
                                    for ($score = 1; $score <= $max_score; $score++) {
                                        if (array_key_exists($score, $score_frequency)) {
                                            echo "<tr><td>{$score}</td><td>{$score_frequency[$score]}</td></tr>";
                                        } else {
                                            echo "<tr><td>{$score}</td><td>0</td></tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Right column for the chart -->
                    <div class="col-md-6">
                        <canvas id="examScoreChart" width="700" height="400"></canvas>
                    </div>
                </div>
                <pre>This chart shows the distribution of exam scores along with their frequency of occurrence.</pre>
            </div>
        </div>
    </div>
</div>

    
    
    <!-- ******************************   chart 4 **************************************************** -->
    <div class="accordion container my-5" id="accordionExample">
        <div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseChart" aria-expanded="false" aria-controls="collapseChart">
            Chart 4: Average Exam Score by Hours Studied
        </button>
    </h2>
    <div id="collapseChart" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <?php
            // Include the PHP file that fetches exam score data
            include '4_HoursStudied.php'; // Sets $hoursStudied and $averageScores
            ?>
            <div class="container my-2">
                <div class="row">
                    <!-- Left column for the table -->
                    <div class="col-md-5">
                        <div class="table-responsive overflow-auto" style="max-height: 300px;">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Hours Studied</th>
                                        <th>Average Exam Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($hoursStudied); $i++) {
                                        echo "<tr>
                                            <td>{$hoursStudied[$i]}</td>
                                            <td>{$averageScores[$i]}</td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Right column for the chart -->
                    <div class="col-md-7">
                        <canvas id="averageScoresChart" width="1000" height="400"></canvas>
                    </div>
                </div>
                <pre>This chart shows the average exam scores grouped by hours studied, providing insights into study patterns and performance.</pre>
            </div>
        </div>
    </div>
</div>
                </div>



<!-- *************************** chart 5 *************************************** -->
 <div class="accordion container my-5" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRadarChart" aria-expanded="false" aria-controls="collapseRadarChart">
                Chart 5: Factors Affecting Exam Score by Quartile
            </button>
        </h2>
        <div id="collapseRadarChart" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <?php
                // Include the PHP file that fetches quartile data
                include '5_resources.php'; // Sets $quartiles, $avgHoursStudied, $avgAttendance, $avgSleepHours, $avgParentalInvolvement
                ?>
                <div class="container my-2">
                    <div class="row">
                        <!-- Left column for the table -->
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Quartile</th>
                                            <th>Avg Hours Studied</th>
                                            <th>Avg Attendance</th>
                                            <th>Avg Sleep Hours</th>
                                            <th>Avg Parental Involvement</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($quartiles); $i++) {
                                            echo "<tr>
                                                <td>{$quartiles[$i]}</td>
                                                <td>{$avgHoursStudied[$i]}</td>
                                                <td>{$avgAttendance[$i]}</td>
                                                <td>{$avgSleepHours[$i]}</td>
                                                <td>{$avgParentalInvolvement[$i]}</td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Right column for the radar chart (aligned right) -->
                        <div class="col-md-6">
                            <canvas id="factorsRadarChart" width="1000" height="400"></canvas>
                        </div>
                    </div>
                    <pre>This chart visualizes the average values of key factors (Hours Studied, Attendance, Sleep Hours, and Parental Involvement) across quartiles of Exam Score.</pre>
                </div>
            </div>
        </div>
    </div>
</div>





    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    </script>
    <script>
        document.getElementById("toggleButton").addEventListener("click", function() {
            var tableContainer = document.getElementById("tableContainer");
            var buttonText = document.getElementById("toggleButton");

            // Toggle visibility of table
            if (tableContainer.style.display === "none") {
                tableContainer.style.display = "block";
                buttonText.textContent = "Hide sample";
            } else {
                tableContainer.style.display = "none";
                buttonText.textContent = "Show sample";
            }
        });

        // Function to generate random colors for the chart
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>



<!-- *************************************** script for chart 1 *********************************************** -->

<!-- Ensure Chart.js is included -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- The canvas element where the chart will render -->
<canvas id="stackedBarChart" width="1000" height="400"></canvas>

<script>
    // Check that 'ctx' is declared only once and isn't being redeclared
const chartCanvas = document.getElementById('stackedBarChart').getContext('2d');
    // Ensure the PHP variables are correctly passed to JavaScript
    const hoursStudied = <?php echo json_encode($hoursStudied); ?>;
    const averageScoresYes = <?php echo json_encode($averageScoresYes); ?>;
    const averageScoresNo = <?php echo json_encode($averageScoresNo); ?>;


const stackedBarChart = new Chart(chartCanvas, {
    type: 'bar',
    data: {
        labels: hoursStudied, // Hours studied as labels on the x-axis
        datasets: [{
            label: 'Average Exam Score (Yes)',
            data: averageScoresYes, // Data for 'Yes' extracurricular activity
            backgroundColor: 'rgba(75, 192, 192, 0.5)', // Color for 'Yes'
            stack: 'stack1',
        }, {
            label: 'Average Exam Score (No)',
            data: averageScoresNo, // Data for 'No' extracurricular activity
            backgroundColor: 'rgba(153, 102, 255, 0.5)', // Color for 'No'
            stack: 'stack1',
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        // Showing the label and value with two decimal places
                        return tooltipItem.dataset.label + ': ' + tooltipItem.raw.toFixed(2);
                    }
                }
            }
        },
        scales: {
            x: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Hours Studied'
                }
            },
            y: {
                beginAtZero: true,
                stacked: true, // Enables stacked bars
                title: {
                    display: true,
                    text: 'Average Exam Score'
                }
            }
        }
    }
});

</script>
 


<!-- *************************************** script for chart 2 *********************************************** -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        // Prepare data for Chart.js
        const schoolTypes = <?php echo json_encode($schoolTypes); ?>;
        const performanceData = <?php echo json_encode($performanceData); ?>;

        // Extract specific data for charting
        const averageScores = performanceData.map(item => item.Average_Score);
        const scoreCounts = performanceData.map(item => item.Score_Count);

        // Create chart
        const ctx = document.getElementById('schoolTypePerformanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: schoolTypes,
                datasets: [
                    {
                        label: 'Average Exam Score',
                        data: averageScores,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Score Count',
                        data: scoreCounts,
                        type: 'line',
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        yAxisID: 'y-right'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Average Exam Score'
                        }
                    },
                    'y-right': {
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Score Count'
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'School Type'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Exam Performance by School Type'
                    }
                }
            }
        });
    </script>


<!-- ********************** script for chart 3 *************************************** -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pass PHP data to JavaScript
        const examScores = <?php echo json_encode($exam_scores); ?>;
        const scoreFrequency = <?php echo json_encode($score_frequency); ?>;

        // Log the data to verify structure
        console.log('Exam Scores:', examScores);
        console.log('Score Frequency:', scoreFrequency);

        // Create the histogram chart using Chart.js
        const ctx = document.getElementById('examScoreChart').getContext('2d');
        const examScoreChart = new Chart(ctx, {
            type: 'bar', // Set to 'bar' for histogram
            data: {
                labels: Object.keys(scoreFrequency), // Exam scores (X-axis labels)
                datasets: [{
                    label: 'Exam Score Distribution',
                    data: Object.values(scoreFrequency), // Frequency data
                    backgroundColor: 'rgba(128, 0, 128, 0.5)', // Purple color
                    borderColor: 'rgba(135, 206, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Exam Score'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Frequency'
                        }
                    }
                }
            }
        });
    });
</script>





<!-- ********************** script for chart 4 *************************************** -->

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Data from PHP
        const hoursStudied = <?php echo json_encode($hoursStudied); ?>;
        const averageScores = <?php echo json_encode($averageScores); ?>;

        // Initialize the chart
        const ctx = document.getElementById('averageScoresChart').getContext('2d');
        const averageScoresChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: hoursStudied,
                datasets: [{
                    label: 'Average Exam Score',
                    data: averageScores,
                    backgroundColor: 'rgba(135, 206, 250, 0.6)',
                    borderColor: 'rgba(70, 130, 180, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Average Exam Score by Hours Studied'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Hours Studied'
                        },
                        ticks: {
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 45
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Average Exam Score'
                        },
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(200, 200, 200, 0.3)',
                            lineWidth: 1,
                            borderDash: [5, 5]
                        }
                    }
                }
            }
        });
    });
</script>


<!-- ********************** script for chart 5 *************************************** -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('factorsRadarChart').getContext('2d');
        const radarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Hours Studied', 'Attendance', 'Sleep Hours', 'Parental Involvement'],
                datasets: [
                    <?php
                    $colors = [
                        'rgba(255, 99, 132, 0.2)', // Quartile 1
                        'rgba(54, 162, 235, 0.2)', // Quartile 2
                        'rgba(255, 206, 86, 0.2)', // Quartile 3
                        'rgba(75, 192, 192, 0.2)', // Quartile 4
                    ];

                    for ($i = 0; $i < count($quartiles); $i++) {
                        echo "{
                            label: 'Quartile {$quartiles[$i]}',
                            data: [{$avgHoursStudied[$i]}, {$avgAttendance[$i]}, {$avgSleepHours[$i]}, {$avgParentalInvolvement[$i]}],
                            fill: true,
                            backgroundColor: '{$colors[$i]}',
                            borderColor: '{$colors[$i]}',
                            borderWidth: 1
                        },";
                    }
                    ?>
                ]
            },
            options: {
                responsive: true,
                scales: {
                    r: {
                        suggestedMin: 0,
                        suggestedMax: 100
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    });
</script>




</body>

</html>