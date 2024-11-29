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
    <title>Remote Work & Mental Health</title>

    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            /* Light background for better contrast */
            color: #343a40;
            /* Dark text for readability */
        }

        /* Card Styles */
        .card {
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
            /* Light border for cards */
            border-radius: 0.5rem;
            /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
        }

        .card-body {
            padding: 20px;
            /* Increased padding for better spacing */
        }

        /* Button Styles */
        .btn-custom {
            background-color: #007bff;
            /* Primary color */
            color: white;
            border: none;
            /* Remove border */
            border-radius: 0.25rem;
            /* Rounded corners */
        }

        .btn-custom:hover {
            background-color: #0056b3;
            /* Darker shade on hover */
            transition: background-color 0.3s;
            /* Smooth transition */
        }

        /* Table Styles */
        .table th,
        .table td {
            vertical-align: middle;
            /* Center align content */
            padding: 12px;
            /* Increased padding for table cells */
        }

        .table-dark {
            background-color: #343a40;
            /* Dark background for table header */
            color: white;
            /* White text for contrast */
        }

        /* Accordion Styles */
        .accordion-button {
            background-color: #e2e6ea;
            /* Light background for accordion buttons */
            color: #343a40;
            /* Dark text */
            border: 1px solid #ced4da;
            /* Border for accordion buttons */
        }

        .accordion-button:not(.collapsed) {
            background-color: #d1d3e0;
            /* Slightly darker when expanded */
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
                /* Add padding for smaller screens */
            }
        }
    </style>
</head>

<body>
    <!-- Container for the Content -->
    <div class="container my-5">
        <h1 class="text-center mb-4">Remote Work & Mental Health</h1>

        <h3 class="mb-3">About the Dataset</h3>
        <p class="mb-4">
            As remote work becomes increasingly common, understanding its effects on employees' mental health is crucial. This dataset explores how working remotely influences stress levels, work-life balance, and mental health conditions across different industries and regions.
        </p>

        <p class="mb-4">
            With 5,000 records from employees worldwide, this dataset offers valuable insights into key factors such as work location (remote, hybrid, onsite), stress levels, access to mental health resources, and job satisfaction. It is designed to support researchers, HR professionals, and businesses in evaluating the growing impact of remote work on employee well-being and productivity. 🌿📈
        </p>

        <h3 class="mb-3">Dataset Columns:</h3>
        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Employee_ID:</strong> A unique identifier for each employee.</li>
            <li class="list-group-item"><strong>Age:</strong> The age of the employee.</li>
            <li class="list-group-item"><strong>Gender:</strong> The gender of the employee.</li>
            <li class="list-group-item"><strong>Job_Role:</strong> The current role of the employee.</li>
            <li class="list-group-item"><strong>Industry:</strong> The industry in which the employee works.</li>
            <li class="list-group-item"><strong>Years_of_Experience:</strong> The number of years the employee has worked.</li>
            <li class="list-group-item"><strong>Work_Location:</strong> The employee's work arrangement (remote, hybrid, or onsite).</li>
            <li class="list-group-item"><strong>Hours_Worked_Per_Week:</strong> The number of hours the employee works per week.</li>
            <li class="list-group-item"><strong>Number_of_Virtual_Meetings:</strong> The number of virtual meetings attended by the employee per week.</li>
            <li class="list-group-item"><strong>Work_Life_Balance_Rating:</strong> A self-reported rating (1-5) of the employee's work-life balance.</li>
            <li class="list-group-item"><strong>Stress_Level:</strong> The employee’s self-reported level of stress.</li>
            <li class="list-group-item"><strong>Mental_Health_Condition:</strong> Any mental health conditions reported (e.g., Anxiety, Depression).</li>
            <li class="list-group-item"><strong>Access_to_Mental_Health_Resources:</strong> Whether the employee has access to mental health resources (Yes/No).</li>
            <li class="list-group-item"><strong>Productivity_Change:</strong> Self-reported changes in productivity (Improved, Neutral, Declined).</li>
            <li class="list-group-item"><strong>Social_Isolation_Rating:</strong> A self-reported rating (1-5) indicating how isolated the employee feels.</li>
            <li class="list-group-item"><strong>Satisfaction_with_Remote_Work:</strong> The employee’s satisfaction level with remote work arrangements (Satisfied, Neutral, Unsatisfied).</li>
            <li class="list-group-item"><strong>Company_Support_for_Remote_Work:</strong> A self-reported rating (1-5) of the company's support for remote work.</li>
            <li class="list-group-item"><strong>Physical_Activity:</strong> The employee's level of physical activity (e.g., Active, Moderate, Sedentary).</li>
            <li class="list-group-item"><strong>Sleep_Quality:</strong> The employee’s self-reported sleep quality (e.g., Good, Fair, Poor).</li>
            <li class="list-group-item"><strong>Region:</strong> The geographical region where the employee resides.</li>
        </ul>

    </div>



    <div class="container my-5 text-center">
        <button id="toggleButton" class="btn btn-secondary btn-sm mb-3">Show sample</button>

        <div class="table-responsive" id="tableContainer" style="display: none;">
            <table class="table table-bordered table-striped table-sm">
                <thead class="table-dark">
                    <tr>
                        <th class="p-3">Employee_ID</th>
                        <th class="p-3">Age</th>
                        <th class="p-3">Gender</th>
                        <th class="p-3">Job_Role</th>
                        <th class="p-3">Industry</th>
                        <th class="p-3">Years_of_Experience</th>
                        <th class="p-3">Work_Location</th>
                        <th class="p-3">Hours_Worked_Per_Week</th>
                        <th class="p-3">Number_of_Virtual_Meetings</th>
                        <th class="p-3">Work_Life_Balance_Rating</th>
                        <th class="p-3">Stress_Level</th>
                        <th class="p-3">Mental_Health_Condition</th>
                        <th class="p-3">Access_to_Mental_Health_Resources</th>
                        <th class="p-3">Productivity_Change</th>
                        <th class="p-3">Social_Isolation_Rating</th>
                        <th class="p-3">Satisfaction_with_Remote_Work</th>
                        <th class="p-3">Company_Support_for_Remote_Work</th>
                        <th class="p-3">Physical_Activity</th>
                        <th class="p-3">Sleep_Quality</th>
                        <th class="p-3">Region</th>
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

                    $sample = "SELECT * FROM employee_data LIMIT 5;";
                    $rs = mysqli_query($conn, $sample);

                    if ($rs->num_rows > 0) {
                        while ($row = $rs->fetch_assoc()) {
                    ?>
                            <tr>
                                <td class="text-center p-3"><?php echo $row['Employee_ID']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Age']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Gender']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Job_Role']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Industry']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Years_of_Experience']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Work_Location']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Hours_Worked_Per_Week']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Number_of_Virtual_Meetings']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Work_Life_Balance_Rating']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Stress_Level']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Mental_Health_Condition']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Access_to_Mental_Health_Resources']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Productivity_Change']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Social_Isolation_Rating']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Satisfaction_with_Remote_Work']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Company_Support_for_Remote_Work']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Physical_Activity']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Sleep_Quality']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Region']; ?></td>
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
    <div class="accordion container my-5" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Chart 1: Age Distribution of Employees
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    // Include the PHP file that fetches age distribution data
                    include 'chart1.php';

                    ?>
                    <div class="container my-2">
                        <!-- <h2 class="text-center">Age Distribution of Employees</h2> -->
                        <!-- <p class="text-center">This chart represents the distribution of employees' ages across different age ranges.</p> -->

                        <div class="row">
                            <!-- Left column for the table -->
                            <div class="col-md-6">
                                <!-- Replace this with your PHP code to display the table -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Age Range</th>
                                            <th>Frequency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Assuming you have fetched age ranges and frequencies from the database in $ages and $frequencies arrays
                                        for ($i = 0; $i < count($ages1); $i++) {
                                            echo "<tr><td>{$ages1[$i]}</td><td>{$frequencies1[$i]}</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Right column for the chart -->
                            <div class="col-md-6">
                                <canvas id="ageDistributionChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <pre>This chart shows that the majority of employees fall within the age ranges of 30-39, 40-49, and 50-59, with a smaller proportion in the 20-29 and 60+ age ranges. This suggests a predominantly mid-career workforce.</pre>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Chart 2: Job Role Distribution of Employees
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    // Include the PHP file that fetches age distribution data
                    include 'chart2.php';

                    ?>
                    <div class="container m-2">
                        <!-- <h2 class="text-center">Job Role Distribution of Employees</h2> -->
                        <!-- <p class="text-center">This chart represents the distribution of employees across different job roles.</p> -->

                        <div class="row">
                            <!-- Left column for the table -->
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Job Role</th>
                                            <th>Frequency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Assuming you have fetched job roles and frequencies from the database in $jobRoles and $frequencies arrays
                                        for ($i = 0; $i < count($jobRoles2); $i++) {
                                            echo "<tr><td>{$jobRoles2[$i]}</td><td>{$frequencies2[$i]}</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Right column for the chart -->
                            <div class="col-md-6">
                                <canvas id="jobRoleDistributionChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <pre>This chart indicates a relatively balanced distribution across various job roles, with Project Managers having a slight edge in numbers. Marketing and Data Science roles have the lowest frequencies, though they are not far behind.</pre>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Chart 3: Industry Distribution
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    // Include the PHP file that fetches age distribution data
                    include 'chart3.php';

                    ?>

                    <div class="container m-2">
                        <!-- <h2 class="text-center">Industry Distribution</h2> -->
                        <!-- <p class="text-center">This chart represents the distribution of employees across different industries.</p> -->

                        <div class="row">
                            <!-- Left column for the table -->
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Industry</th>
                                            <th>Frequency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch industry data and frequencies from the database
                                        // Assuming the $industryLabels and $industryData arrays contain labels and frequencies
                                        for ($i = 0; $i < count($industryLabels); $i++) {
                                            echo "<tr><td>{$industryLabels[$i]}</td><td>{$industryData[$i]}</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Right column for the chart -->
                            <div class="col-md-6">
                                <canvas id="industryDistributionChart" width="250" height="250"></canvas>
                            </div>
                        </div>
                        <pre>The chart reveals that employees are fairly evenly spread across industries, with Finance and IT leading slightly. Consulting, Manufacturing, and Education have slightly lower employee counts but are still well-represented.</pre>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                    Chart 4: Work Location vs. Productivity Change
                </button>
            </h2>
            <div id="collapsefour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    // Include the PHP file that fetches work location data
                    include 'chart4.php';
                    ?>

                    <div class="container m-2">
                        <!-- <h2 class="text-center">Work Location vs. Productivity Change</h2> -->
                        <!-- <p class="text-center">This chart represents the productivity change across different work locations.</p> -->

                        <div class="row">
                            <!-- Left column for the table -->
                            <div class="col-md-6 d-flex justify-content-center">
                                <table class="table table-bordered" style="max-width: 90%;">
                                    <thead>
                                        <tr>
                                            <th>Work Location</th>
                                            <th>Increase</th>
                                            <th>Decrease</th>
                                            <th>No Change</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Render table rows with fetched data
                                        foreach ($workLocationLabels as $location) {
                                            echo "<tr><td>{$location}</td>";
                                            echo "<td>" . ($workLocationData[$location]['Increase'] ?? 0) . "</td>";
                                            echo "<td>" . ($workLocationData[$location]['Decrease'] ?? 0) . "</td>";
                                            echo "<td>" . ($workLocationData[$location]['No Change'] ?? 0) . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Right column for the chart -->
                            <div class="col-md-6 d-flex justify-content-center">
                                <canvas id="workLocationChart" style="max-width: 80%; max-height: 300px;"></canvas>
                            </div>
                        </div>
                        <pre>This chart shows that productivity tends to decrease slightly more than it increases across all work locations, with remote work having the highest productivity increase rate, closely followed by hybrid and onsite.</pre>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                    Chart 5: Mental Health Condition by Job Role
                </button>
            </h2>
            <div id="collapsefive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    // Include the PHP file that fetches mental health data by job role
                    include 'chart5.php';
                    ?>

                    <div class="container m-2">
                        <!-- <h2 class="text-center">Mental Health Condition by Job Role</h2> -->
                        <!-- <p class="text-center">This chart represents the distribution of mental health conditions across different job roles.</p> -->

                        <div class="row">
                            <!-- Left column for the table -->
                            <div class="col-md-6">
                                <!-- <h4>Job Role and Mental Health Condition Table</h4> -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Job Role</th>
                                            <th>Mental Health Condition</th>
                                            <th>Frequency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($mentalHealthData5 as $role => $conditions) {
                                            foreach ($conditions as $condition => $frequency5) {
                                                echo "<tr><td>{$role}</td><td>{$condition}</td><td>{$frequency5}</td></tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Right column for the chart -->
                            <div class="col-md-6 d-flex align-items-center">
                                <canvas id="mentalHealthChart" style="width: 100%; height: 1000px;"></canvas>
                            </div>
                            <pre>Burnout is the most prevalent mental health condition among employees across various job roles</pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                    Chart 6: Mean Age across Job Roles and Industries
                </button>
            </h2>
            <div id="collapsesix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    // Include the PHP file that fetches mean age data by job role and industry
                    include 'chart6.php';
                    ?>

                    <div class="container m-2">
                        <!-- <h2 class="text-center">Mean Age across Job Roles and Industries</h2> -->
                        <!-- <p class="text-center">This chart represents the mean age distribution across various job roles and industries.</p> -->

                        <div class="row">
                            <!-- Left column for the table -->
                            <div class="col-lg-6 col-md-12 d-flex justify-content-center flex-column align-items-center">
                                <!-- <h4 class="text-center">Job Role and Industry Mean Age Table</h4> -->
                                <div style="max-height: 400px; overflow-y: auto; width: 100%;">
                                    <table class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th>Job Role</th>
                                                <th>Industry</th>
                                                <th>Mean Age</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($jobRoles6 as $index => $role) {
                                                $industry = $industries6[$index];
                                                $meanAge = $meanAges6[$index];
                                                echo "<tr><td>{$role}</td><td>{$industry}</td><td>{$meanAge}</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Right column for the chart -->
                            <div class="col-lg-6 col-md-12 d-flex justify-content-center align-items-center">
                                <canvas id="meanAgeChart" width="800" height="700"></canvas>
                            </div>
                        </div>
                        <pre>The chart shows that mean ages across job roles and industries vary only slightly, with employees generally around 40 years old. Notably, Data Scientists in Education and Designers in Healthcare have slightly higher mean ages,indicating these roles in these industries may attract or retain more experienced employees.</pre>
                    </div>


                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                    Chart 7: Number of Remote Workers by Age Group
                </button>
            </h2>
            <div id="collapse8" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="container m-2">
                        <!-- Dropdown for work location selection -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="workLocation" class="form-label">Select Work Location:</label>
                                <select id="workLocation" class="form-select">
                                    <option value="remote" selected>Remote</option>
                                    <option value="hybrid">Hybrid</option>
                                    <option value="onsite">Onsite</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Left column for the table -->
                            <div class="col-md-6">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Age Range</th>
                                            <th>Number of Workers</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Rows will be dynamically populated -->
                                    </tbody>
                                </table>
                            </div>

                            <!-- Right column for the chart -->
                            <div class="col-md-6">
                                <canvas id="remoteWorkerChart" width="400" height="200"></canvas>
                            </div>
                            <pre id="summary">Summary: Employees aged 25-34 and 45-54 are significantly more likely to work remotely compared to other age groups.</pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                    Chart 8: Distribution of Employees by Age and Experience
                </button>
            </h2>
            <div id="collapse9" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    // Include the PHP file that fetches age distribution data
                    include 'chart8.php';
                    ?>
                    <div class="container mt-5">
                        <!-- <h2 class="text-center">Distribution of Employees by Age and Experience</h2> -->
                        <!-- <p class="text-center">This chart represents the distribution of employees across different age groups and years of experience.</p> -->

                        <div class="row">
                            <!-- Left column for the table -->
                            <div class="col-lg-6 col-md-12 d-flex justify-content-center flex-column align-items-center">
                                <!-- <h4 class="text-center">Age Group and Experience Distribution Table</h4> -->
                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th>Age Group</th>
                                            <?php foreach ($experienceGroups as $experienceGroup): ?>
                                                <th><?php echo $experienceGroup; ?> Years</th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ageGroups8 as $ageIndex => $ageGroup8): ?>
                                            <tr>
                                                <td><?php echo $ageGroup8; ?></td>
                                                <?php foreach ($experienceGroups as $expIndex => $experienceGroup): ?>
                                                    <td><?php echo $counts[$ageIndex][$expIndex]; ?></td>
                                                <?php endforeach; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Right column for the chart -->
                            <div class="col-lg-6 col-md-12 d-flex justify-content-center align-items-center">
                                <canvas id="ageExperienceChart" width="800" height="700"></canvas>
                            </div>
                            <pre>Older people usually Age (60-69) have more work experience. This means that as people get older, they gain more skills and knowledge from their jobs</pre>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                    Chart 9: Age vs. Years of Experience
                </button>
            </h2>
            <div id="collapse11" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php include 'chart9.php'; ?>
                    <div class="container m-2">
                        <!-- <h2 class="text-center">Age vs. Years of Experience</h2> -->
                        <!-- <p class="text-center">Scatter plot showing the relationship between Age and Years of Experience, categorized by Gender.</p> -->

                        <div class="row">
                            <!-- Left column for the table -->
                            <div class="col-lg-6 col-md-12">
                                <!-- <h4 class="text-center">Age and Experience Data</h4> -->
                                <div style="max-height: 400px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">
                                    <table class="table table-bordered mt-3" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Age</th>
                                                <th>Years of Experience</th>
                                                <th>Gender</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Display age, experience, and gender data in the table
                                            foreach ($ageExperienceData as $data) {
                                                echo "<tr><td>{$data['age']}</td><td>{$data['experience']}</td><td>{$data['gender']}</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Right column for the chart -->
                            <div class="col-lg-6 col-md-12 d-flex justify-content-center align-items-center">
                                <canvas id="ageExperienceChart2" width="400" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                    Chart 10: Remote Work Distribution by Gender
                </button>
            </h2>
            <div id="collapse12" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    // Include the PHP file that fetches the data
                    include 'chart10.php';  // This file fetches the necessary data
                    ?>
                    <div class="container m-2">
                        <!-- <h2 class="text-center">Remote Work Distribution by Gender</h2> -->
                        <!-- <p class="text-center">This chart shows the distribution of remote work across different genders.</p> -->

                        <div class="row">
                            <!-- Left column for the data table -->
                            <div class="col-lg-6 col-md-12 d-flex justify-content-center flex-column align-items-center">
                                <!-- <h4 class="text-center">Remote Work Distribution Table</h4> -->
                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th>Gender</th>
                                            <th>Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($remoteWorkCounts)) {
                                            // Decode the JSON data back to PHP array to display it in the table
                                            $remoteWorkCountsArray = json_decode($remoteWorkCountsJson, true);
                                            foreach ($remoteWorkCountsArray as $entry) {
                                                // Echo the gender and count in the table rows
                                                echo "<tr><td>{$entry['gender']}</td><td>{$entry['count']}</td></tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='2'>No data available</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Right column for the pie chart -->
                            <div class="col-lg-6 col-md-12 d-flex justify-content-center align-items-center">
                                <canvas id="remoteWorkPieChart" width="300px" height="300px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                    Chart 11: Satisfaction with Remote Work by Industry
                </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    // Include the PHP file that fetches the data
                    include 'chart11.php';  // This file fetches the necessary data
                    ?>
                    <div class="container m-2">
                        <!-- <h2 class="text-center">Satisfaction with Remote Work by Industry</h2> -->
                        <!-- <p class="text-center">This chart shows the satisfaction levels of remote work across different industries.</p> -->

                        <div class="row">
                            <!-- Left column for the table -->
                            <div class="col-lg-6 col-md-12 d-flex justify-content-center flex-column align-items-center">
                                <!-- <h4 class="text-center">Satisfaction by Industry Table</h4> -->
                                <div class="table-responsive" style="max-height: 400px; overflow-y: auto; width: 100%;"> <!-- Scrollable table -->
                                    <table class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th>Industry</th>
                                                <th>Satisfaction Level</th>
                                                <th>Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($satisfactionData)) {
                                                foreach ($satisfactionData as $industry => $satisfactionLevels) {
                                                    foreach ($satisfactionLevels as $level => $count) {
                                                        echo "<tr><td>{$industry}</td><td>{$level}</td><td>{$count}</td></tr>";
                                                    }
                                                }
                                            } else {
                                                echo "<tr><td colspan='3'>No data available</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Right column for the bar chart -->
                            <div class="col-lg-6 col-md-12 d-flex justify-content-center align-items-center">
                                <canvas id="satisfactionChart" width="800" height="700"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
                    Chart 12: Stress Level by Work Location
                </button>
            </h2>
            <div id="collapse14" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php include 'chart12.php'; ?>
                    <div class="container m-2">
                        <!-- <h2 class="text-center">Stress Level by Work Location</h2> -->
                        <!-- <p class="text-center">This chart represents the distribution of stress levels across different work locations.</p> -->

                        <div class="row">
                            <!-- Left column for the table -->
                            <div class="col-md-6">
                                <!-- <h4>Stress Level Table</h4> -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Work Location</th>
                                            <th>Stress Level</th>
                                            <th>Frequency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data as $level => $counts) {
                                            foreach ($counts as $location => $count) {
                                                echo "<tr><td>{$location}</td><td>{$level}</td><td>{$count}</td></tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Right column for the chart -->
                            <div class="col-md-6">
                                <canvas id="stressLevelChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
                    Chart 13: Mental Health Condition by Work Location
                </button>
            </h2>
            <div id="collapse15" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php include 'chart13.php'; ?>
                    <div class="container m-2">
                        <!-- <h2 class="text-center">Mental Health Condition by Work Location</h2> -->
                        <!-- <p class="text-center">This chart represents the distribution of mental health conditions across different work locations.</p> -->

                        <div class="row">
                            <div class="col-md-6">
                                <!-- <h4>Mental Health Condition Table</h4> -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Work Location</th>
                                            <th>Mental Health Condition</th>
                                            <th>Frequency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data as $condition => $counts) {
                                            foreach ($counts as $location => $count) {
                                                echo "<tr><td>{$location}</td><td>{$condition}</td><td>{$count}</td></tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <canvas id="chart13" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>











    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ageLabels = <?php echo json_encode($ages1); ?>;
            const ageData = <?php echo json_encode($frequencies1); ?>;

            const ctx = document.getElementById('ageDistributionChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ageLabels,
                    datasets: [{
                        label: 'Frequency',
                        data: ageData,
                        backgroundColor: getRandomColor(),
                        borderColor: getRandomColor(),
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>


    <script>
        // JavaScript to generate the Job Role Distribution chart using Chart.js
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('jobRoleDistributionChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: jobRoleLabels, // PHP variable converted to JS array
                    datasets: [{
                        label: 'Number of Employees',
                        data: jobRoleData, // PHP variable converted to JS array
                        backgroundColor: getRandomColor(),
                        borderColor: getRandomColor(),
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y', // This makes the bar chart horizontal
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Count'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Job Role'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Job Role Distribution'
                        }
                    }
                }
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const industryLabels = <?php echo json_encode($industryLabels); ?>;
            const industryData = <?php echo json_encode($industryData); ?>;

            const colors = [
                getRandomColor(),
                getRandomColor(),
                getRandomColor(),
                getRandomColor(),
                getRandomColor(),
                getRandomColor(),
                getRandomColor(),
                getRandomColor(),
                getRandomColor(),
                getRandomColor()
            ];

            const ctx = document.getElementById('industryDistributionChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: industryLabels,
                    datasets: [{
                        data: industryData,
                        backgroundColor: colors,
                        borderColor: colors.map(color => color.replace('0.7', '1')),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Allow resizing freely
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Industry Distribution'
                        }
                    },
                    cutoutPercentage: 70 // Reduce this value to make the hole smaller (larger doughnut)
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch data from PHP-encoded arrays
            const workLocationLabels = <?php echo json_encode($workLocationLabels); ?>;
            const productivityIncreaseData = <?php echo json_encode($productivityIncreaseData); ?>;
            const productivityDecreaseData = <?php echo json_encode($productivityDecreaseData); ?>;
            const productivityNoChangeData = <?php echo json_encode($productivityNoChangeData); ?>;

            const ctx = document.getElementById('workLocationChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: workLocationLabels,
                    datasets: [{
                            label: 'Increase',
                            data: productivityIncreaseData,
                            backgroundColor: getRandomColor(),
                            borderColor: getRandomColor(),
                            borderWidth: 1
                        },
                        {
                            label: 'Decrease',
                            data: productivityDecreaseData,
                            backgroundColor: getRandomColor(),
                            borderColor: getRandomColor(),
                            borderWidth: 1
                        },
                        {
                            label: 'No Change',
                            data: productivityNoChangeData,
                            backgroundColor: getRandomColor(),
                            borderColor: getRandomColor(),
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

    <script>
        // console.log("chart5 called");

        document.addEventListener("DOMContentLoaded", function() {
            // console.log("chart5 loaded and initialized");

            // Debugging: Log PHP arrays converted to JavaScript
            const jobRoles = <?php echo json_encode(array_keys($mentalHealthData5)); ?>;
            const mentalHealthData = <?php echo json_encode($mentalHealthData5); ?>;

            // Flatten conditions from the data
            const conditions = [...new Set(Object.values(mentalHealthData).flatMap(Object.keys))];

            // console.log("Job Roles:", jobRoles);
            // console.log("Conditions:", conditions);
            // console.log("Mental Health Data:", mentalHealthData);

            // Define datasets for each mental health condition
            const dataSets = conditions.map((condition, index) => ({
                label: condition,
                data: jobRoles.map(role => (mentalHealthData[role] || {})[condition] || 0),
                // backgroundColor: `rgba(75, 192, 192, ${(index + 1) * 0.2})`,
                backgroundColor: getRandomColor(),
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }));

            // Debugging: Check constructed datasets for Chart.js
            // console.log("Constructed datasets:", dataSets);

            // Get the chart context
            const ctx = document.getElementById('mentalHealthChart').getContext('2d');

            // Create the chart
            try {
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: jobRoles,
                        datasets: dataSets
                    },
                    options: {
                        indexAxis: 'y', // Horizontal bar chart
                        scales: {
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Count'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Job Role'
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Mental Health Condition by Job Role',
                                font: {
                                    size: 16,
                                    weight: 'bold'
                                }
                            },
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        }
                    }
                });
            } catch (error) {
                console.error("Error initializing chart:", error);
            }
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // PHP variables for JavaScript
            const jobRoles6 = <?php echo json_encode($jobRoles6); ?>;
            const industries6 = <?php echo json_encode($industries6); ?>;
            const meanAges6 = <?php echo json_encode($meanAges6); ?>;

            // Process data for Chart.js
            const uniqueJobRoles = [...new Set(jobRoles6)];
            const uniqueIndustries = [...new Set(industries6)];

            // Organize data by industry for each job role
            const datasets = uniqueIndustries.map(industry => {
                return {
                    label: industry,
                    backgroundColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.6)`,
                    borderColor: 'rgba(0, 0, 0, 0.1)',
                    borderWidth: 1,
                    data: uniqueJobRoles.map(role => {
                        const index = jobRoles6.findIndex((r, i) => r === role && industries6[i] === industry);
                        return index !== -1 ? meanAges6[index] : 0;
                    })
                };
            });

            const ctx = document.getElementById('meanAgeChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: uniqueJobRoles,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Mean Age across Job Roles and Industries'
                        }
                    },
                    scales: {
                        x: {
                            stacked: false,
                            title: {
                                display: true,
                                text: 'Job Roles'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Mean Age'
                            }
                        }
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('remoteWorkerChart').getContext('2d');
            let workerChart;

            function getRandomColorArray(size) {
                return Array.from({
                        length: size
                    }, () =>
                    `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`
                );
            }

            function updateChartAndTable(location) {
                $.ajax({
                    url: 'chart7.php',
                    type: 'POST',
                    data: {
                        location: location
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Update table
                        const tableBody = $('#dataTable tbody');
                        tableBody.empty(); // Clear existing table rows
                        data.ageGroups.forEach((ageGroup, index) => {
                            tableBody.append(`<tr><td>${ageGroup}</td><td>${data.workCounts[index]}</td></tr>`);
                        });

                        // Update chart
                        if (workerChart) {
                            workerChart.destroy(); // Destroy previous chart instance
                        }

                        workerChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: data.ageGroups,
                                datasets: [{
                                    label: `Number of Workers (${location})`,
                                    data: data.workCounts,
                                    backgroundColor: getRandomColorArray(data.ageGroups.length),
                                    borderColor: 'rgba(0, 128, 128, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        grid: {
                                            display: true,
                                            drawBorder: false,
                                            color: 'rgba(0, 0, 0, 0.1)'
                                        }
                                    },
                                    x: {
                                        grid: {
                                            display: false
                                        }
                                    }
                                }
                            }
                        });

                        // Update summary
                        $('#summary').text(data.summary);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching chart data:', error);
                    }
                });
            }

            // Initial load with default value
            updateChartAndTable('remote');

            // Update chart and table on dropdown change
            $('#workLocation').on('change', function() {
                const selectedLocation = $(this).val();
                updateChartAndTable(selectedLocation);
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch data from PHP
            const ageGroups8 = <?php echo $ageGroupsJSON; ?>;
            const experienceGroups = <?php echo $experienceGroupsJSON; ?>; // Pass experienceGroups to JavaScript
            const counts = <?php echo $countsJSON; ?>;

            console.log(ageGroups8, experienceGroups, counts); // Debugging: Check if the data is correct

            if (!Array.isArray(ageGroups8) || !Array.isArray(experienceGroups) || !Array.isArray(counts)) {
                console.error("Invalid data format!");
                return;
            }

            const datasets = experienceGroups.map(function(experienceGroup, index) {
                return {
                    label: experienceGroup,
                    data: counts.map(count => count[index]),
                    backgroundColor: ['#4CAF50', '#FF9800', '#2196F3', '#8BC34A', '#9C27B0'][index], // Color for each group
                };
            });

            const ctx1 = document.getElementById('ageExperienceChart').getContext('2d');

            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: ageGroups8,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    scales: {
                        x: {
                            stacked: true, // Enable stacking on x-axis
                        },
                        y: {
                            stacked: true, // Enable stacking on y-axis
                        }
                    }
                }
            });
        });
    </script>

    <script>
        // Organize data for Chart.js
        const genderColors = {
            'Male': getRandomColor(),
            'Female': getRandomColor(),
            'Non-binary': getRandomColor(),
            'Prefer not to say': getRandomColor()
        };

        const data = ageExperienceData.map(item => ({
            x: item.age,
            y: item.experience,
            backgroundColor: genderColors[item.gender] || getRandomColor(),
            gender: item.gender
        }));

        // Create the scatter plot
        new Chart(document.getElementById('ageExperienceChart2').getContext('2d'), {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Age vs. Years of Experience',
                    data: data,
                    parsing: {
                        xAxisKey: 'x',
                        yAxisKey: 'y'
                    },
                    pointBackgroundColor: data.map(item => item.backgroundColor)
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: context => {
                                const item = context.raw;
                                return `Gender: ${item.gender} | Age: ${item.x} | Experience: ${item.y} yrs`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Age'
                        },
                        type: 'linear',
                        position: 'bottom'
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Years of Experience'
                        }
                    }
                }
            }
        });
    </script>

    <script>
        // Ensure the remote work data is passed correctly from PHP to JS
        var remoteWorkData = <?php echo $remoteWorkCountsJson; ?>;

        // Prepare the data for the pie chart
        var labels = remoteWorkData.map(function(item) {
            return item.gender;
        });

        var counts = remoteWorkData.map(function(item) {
            return item.count;
        });

        // Create the pie chart using Chart.js
        var ctx = document.getElementById('remoteWorkPieChart').getContext('2d');
        var remoteWorkPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels, // Gender labels
                datasets: [{
                    data: counts, // Counts of remote workers by gender
                    backgroundColor: [getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor()], // Colors for each slice
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Disable aspect ratio if you want to freely resize the chart
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ": " + tooltipItem.raw + " employees";
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script>
        // Parsing the satisfaction data
        const satisfactionData = <?php echo $satisfactionDataJson; ?>;

        // Log the satisfaction data to verify the structure
        console.log('Satisfaction Data:', satisfactionData);

        // Get the industries (keys of the satisfactionData object)
        const industries = Object.keys(satisfactionData);

        // Extract all unique satisfaction levels (e.g., 'Unsatisfied', 'Neutral', 'Satisfied')
        const satisfactionLevels = Array.from(new Set([].concat(...Object.values(satisfactionData).map(levels => Object.keys(levels)))));

        // If `datasets` is already defined, use it; otherwise, initialize it
        if (typeof datasets === 'undefined') {
            datasets = []; // Declare `datasets` if not already defined
        }

        // Clear the datasets array (to avoid old data)
        datasets.length = 0;

        // Fill the datasets with satisfaction levels and corresponding data
        satisfactionLevels.forEach(level => {
            datasets.push({
                label: level,
                data: industries.map(industry => satisfactionData[industry][level] || 0), // Ensure data is correctly filled
                backgroundColor: getRandomColor(), // Random color for each satisfaction level
                borderColor: '#fff',
                borderWidth: 1
            });
        });

        // Initialize the chart
        const ctx11 = document.getElementById('satisfactionChart').getContext('2d');
        const satisfactionChart = new Chart(ctx11, {
            type: 'bar', // Change to 'bar' type
            data: {
                labels: industries, // X-axis labels (industries)
                datasets: datasets // Y-axis data (satisfaction levels)
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Satisfaction with Remote Work by Industry',
                    fontSize: 16,
                    fontWeight: 'bold'
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Industry'
                        },
                        // Adjust the category percentage for proper spacing
                        ticks: {
                            autoSkip: false // Make sure the labels for industries are not skipped
                        },
                        grid: {
                            offset: true // Adjust grid to align properly with stacked bars
                        },
                        stacked: true // Stack the bars on the X-axis as well
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Count'
                        },
                        beginAtZero: true,
                        stacked: true, // Stack the bars on top of each other
                        grid: {
                            drawBorder: false // Avoid grid lines on the borders
                        }
                    }
                },
                // Adjust the bar width and spacing to avoid overlap
                barPercentage: 0.8, // Makes bars thinner to prevent overlap
                categoryPercentage: 0.8, // Adjust the spacing between bars
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.dataset.label}: ${tooltipItem.raw} employees`;
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script>
        const ctx12 = document.getElementById('stressLevelChart').getContext('2d');

        // Decode PHP JSON-encoded data
        const locations = <?php echo $locations_js; ?>;
        const datasets = <?php echo $datasets_js; ?>;

        // Assign a random color to each dataset's background
        datasets.forEach(dataset => {
            dataset.backgroundColor = getRandomColor();
        });

        // Create the chart
        new Chart(ctx12, {
            type: 'bar',
            data: {
                labels: locations,
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Stress Level by Work Location'
                    }
                },
                scales: {
                    x: {
                        stacked: false
                    },
                    y: {
                        stacked: false,
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('chart13').getContext('2d');

            // Decode PHP JSON-encoded data
            const workLocations = <?php echo $workLocations_js; ?>;
            const mentalHealthDatasets = <?php echo $mentalHealthDatasets_js; ?>;

            // Assign random colors to each dataset
            mentalHealthDatasets.forEach(dataset => {
                dataset.backgroundColor = getRandomColor();
            });

            // Create the Chart
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: workLocations,
                    datasets: mentalHealthDatasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Mental Health Condition by Work Location'
                        }
                    },
                    scales: {
                        x: {
                            stacked: false
                        },
                        y: {
                            stacked: false,
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>





</body>

</html>