<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Include the Chart.js Boxplot Plugin -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-chart-boxplot"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
      <!-- Container for the Content -->
<div class="container my-5">
    <h1 class="text-center mb-4">Global Air Quality & Pollution Trends</h1>
    
    <h3 class="mb-3">About the Dataset</h3>
    <p class="lead">
        Air quality is a critical factor affecting the health and well-being of populations worldwide. This dataset provides a comprehensive overview of air pollution levels in various cities, enabling a deeper understanding of pollution trends across different months of the year. It includes rankings and detailed monthly measurements to compare air quality between cities.
    </p>

    <p class="mb-4">
        With pollution data collected from cities across the globe, this dataset offers insights into annual and monthly pollution levels, helping researchers, policymakers, and environmental advocates analyze trends and tackle air quality issues. 🌍💨
    </p>

    <h3 class="mb-3">Dataset Columns:</h3>
    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>Rank:</strong> The rank of the city based on its average annual pollution levels.</li>
        <li class="list-group-item"><strong>City:</strong> The name of the city along with the country.</li>
        <li class="list-group-item"><strong>Avg:</strong> The average pollution measurement for the year.</li>
        <li class="list-group-item"><strong>Jan - Dec:</strong> Monthly average pollution measurements for each month from January to December.</li>
    </ul>

    <h3 class="mb-3">Purpose:</h3>
    <p class="lead">
        This dataset serves as a foundation for visualizing air quality trends across different cities worldwide. The goal is to create insightful and interactive visualizations that help users understand the global pollution landscape. By exploring the data through various charts and graphs, the project aims to raise awareness about air pollution levels, identify patterns, and highlight areas that require environmental attention and improvement.
    </p>

    <h3 class="mb-3">Use Cases:</h3>
    <ul class="list-group mb-4">
        <li class="list-group-item">
            <strong>Visualizing Seasonal Trends in Air Quality:</strong> 
            Use line charts or area charts to show the variation in air quality (pollution levels) across different months of the year. This allows users to understand seasonal pollution patterns in various cities and compare trends over time.
        </li>
        <li class="list-group-item">
            <strong>City Pollution Rankings:</strong> 
            Display rankings of cities based on average pollution levels using bar charts or horizontal bar graphs. This will help users quickly identify cities with the highest or lowest pollution levels.
        </li>
       
        <li class="list-group-item">
            <strong>Monthly pollution Trends:</strong>
            Use line graphs to compare monthly pollution for each city. This allows users to see if certain months have drastically higher or lower pollution compared to the average.
        </li>
        <li class="list-group-item">
            <strong>Pollution Data Over Time:</strong> 
            Display interactive line charts that show pollution measurements over time, allowing users to zoom in on specific months or years. This helps identify long-term trends and fluctuations in air quality.
        </li>
    </ul>
</div>




    <div class="container my-5 text-center">
        <button id="toggleButton" class="btn btn-secondary btn-sm mb-3">Show sample</button>

        <div class="table-responsive" id="tableContainer" style="display: none;">
            <table class="table table-bordered table-striped table-sm">
                <thead class="table-dark">
                    <tr>
                        <th class="p-3">ranki</th>
                        <th class="p-3"> city</th>
                        <th class="p-3">city_name</th>
                        <th class="p-3">country</th>
                        <th class="p-3">avg</th>
                        <th class="p-3">jan</th>
                        <th class="p-3">feb</th>
                        <th class="p-3">mar</th>
                        <th class="p-3">apr</th>
                        <th class="p-3">may</th>
                        <th class="p-3">jun</th>
                        <th class="p-3">jul</th>
                        <th class="p-3">aug</th>
                        <th class="p-3">sep</th>
                        <th class="p-3">oct</th>
                        <th class="p-3">nov</th>
                        <th class="p-3">dece</th>
                        
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

                    $sample = "SELECT * FROM air_quality LIMIT 5;";
                    // $rs = mysqli_query($conn, $sample);
                    if ($rs=mysqli_query($conn, $sample)) {
    // echo "Database created or already exists.";
} else {
    echo "Error creating database: " . $conn->error;
}
                    if ($rs->num_rows > 0) {
                        while ($row = $rs->fetch_assoc()) {
                    ?>
                            <tr>
                                <td class="text-center p-3"><?php echo $row['ranki']; ?></td>
                                <td class="text-center p-3"><?php echo $row['city']; ?></td>
                                <td class="text-center p-3"><?php echo $row['city_name']; ?></td>
                                <td class="text-center p-3"><?php echo $row['country']; ?></td>
                                <td class="text-center p-3"><?php echo $row['avg']; ?></td>
                                <td class="text-center p-3"><?php echo $row['jan']; ?></td>
                                <td class="text-center p-3"><?php echo $row['feb']; ?></td>
                                <td class="text-center p-3"><?php echo $row['mar']; ?></td>
                                <td class="text-center p-3"><?php echo $row['apr']; ?></td>
                                <td class="text-center p-3"><?php echo $row['may']; ?></td>
                                <td class="text-center p-3"><?php echo $row['jun']; ?></td>
                                <td class="text-center p-3"><?php echo $row['jul']; ?></td>
                                <td class="text-center p-3"><?php echo $row['aug']; ?></td>
                                <td class="text-center p-3"><?php echo $row['sep']; ?></td>
                                <td class="text-center p-3"><?php echo $row['oct']; ?></td>
                                <td class="text-center p-3"><?php echo $row['nov']; ?></td>
                                <td class="text-center p-3"><?php echo $row['dece']; ?></td>
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

    <script>
    document.getElementById("toggleButton").addEventListener("click", function() {
        var tableContainer = document.getElementById("tableContainer");

        // Toggle the display style
        if (tableContainer.style.display === "none") {
            tableContainer.style.display = "block";
            this.textContent = "Hide sample"; // Change button text
        } else {
            tableContainer.style.display = "none";
            this.textContent = "Show sample"; // Change button text
        }
    });
</script>


   <div class="container my-5">
    <h2>Data Visualization: Global Air Quality and Pollution Trends</h2>
    <p class="lead">
        Below, you will find visual representations of air quality trends across various cities and regions based on our dataset. 
        These visualizations highlight key patterns and insights regarding pollution levels, seasonal trends, and global comparisons.
        Explore the charts to understand how different cities rank in terms of pollution, identify pollution hotspots, and examine the seasonal variations in air quality throughout the year.
    </p>
</div>


    <!-- Example Data Visualization Section -->
   <div class="accordion container my-5" id="airQualityAccordion">
    <!-- Chart 1: Air Quality Across Different Cities -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAirQuality" aria-expanded="false" aria-controls="collapseAirQuality">
                Chart 1: Air Quality Across Different Cities
            </button>
        </h2>
        <div id="collapseAirQuality" class="accordion-collapse collapse" data-bs-parent="#airQualityAccordion">
            <div class="accordion-body">
                <?php include 'chart1.php'; ?>
                <div class="container m-2">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>City</th>
                                        <th>Average Air Quality</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < 5; $i++) {
                                        echo "<tr><td>{$cityNames[$i]}</td><td>{$avgValues[$i]}</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <canvas id="airQualityChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <pre>This chart shows the average air quality across different cities, providing insight into urban environmental conditions.</pre>
                </div>
            </div>
        </div>
    </div>


    <!-- Chart 2: Monthly Pollution Trends -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMonthlyPollution" aria-expanded="false" aria-controls="collapseMonthlyPollution">
                Chart 2: Monthly Pollution Trends for Cities
            </button>
        </h2>
        <div id="collapseMonthlyPollution" class="accordion-collapse collapse" data-bs-parent="#airQualityAccordion">
            <div class="accordion-body">
                <?php include 'chart2.php'; ?>
                <div class="container m-2">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>City</th>
                                        <th>Month</th>
                                        <th>Average Pollution</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $rowCount = 0;
                                    foreach ($pollutionData as $city => $data) {
                                        foreach ($data as $monthData) {
                                            echo "<tr>
                                                    <td>{$city}</td>
                                                    <td>{$monthData['month']}</td>
                                                    <td>{$monthData['pollution']}</td>
                                                  </tr>";
                                            $rowCount++;
                                            if ($rowCount >= 10) break 2;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <canvas id="monthlyPollutionChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <pre>This line chart illustrates the monthly pollution trends across different cities.</pre>
                </div>
            </div>
        </div>
    </div>







  <!-- Chart 3: Top Polluted Cities -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTopPollutedCities" aria-expanded="false" aria-controls="collapseTopPollutedCities">
                Chart 3: Ranking of the Most Polluted Cities
            </button>
        </h2>
        <div id="collapseTopPollutedCities" class="accordion-collapse collapse" data-bs-parent="#airQualityAccordion">
            <div class="accordion-body">
                <?php include 'chart3.php'; ?>
                <div class="container m-2">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>City</th>
                                        <th>Average Air Quality</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($cityNames); $i++) {
                                        echo "<tr><td>{$rankings[$i]}</td><td>{$cityNames[$i]}</td><td>{$avgValues[$i]}</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <canvas id="airQualityChart3" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <pre>This chart ranks the top 15 most polluted cities based on their average air quality values.</pre>
                </div>
            </div>
        </div>
    </div>





 <!-- Chart 4: Pollution Levels Across Cities -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePollutionLevels" aria-expanded="false" aria-controls="collapsePollutionLevels">
                Chart 4: Share of Pollution Levels Across Different Cities
            </button>
        </h2>
        <div id="collapsePollutionLevels" class="accordion-collapse collapse" data-bs-parent="#airQualityAccordion">
            <div class="accordion-body">
                <?php include 'chart4.php'; ?>
                <div class="container m-2">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>City</th>
                                        <th>Average Pollution</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($cityNames as $index => $city) {
                                        echo "<tr><td>{$city}</td><td>{$avgValues[$index]}</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <canvas id="pollutionChart" width="500" height="500"></canvas>
                        </div>
                    </div>
                    <pre>This pie chart shows the percentage share of pollution levels in different cities for <?php echo $month; ?>.</pre>
                </div>
            </div>
        </div>
    </div>


<div class="accordion-item" id="pollutionAccordion">
    <!-- Chart 1: Worst Pollution Months for Different Cities -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePollution" aria-expanded="false" aria-controls="collapsePollution">
                Chart 5: Worst Pollution Months for Different Cities
            </button>
        </h2>
        <div id="collapsePollution" class="accordion-collapse collapse" data-bs-parent="#airQualityAccordion">
            <div class="accordion-body">
                <?php include 'chart5.php'; ?>
                <div class="container m-2">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>City</th>
                                        <th>Worst Pollution Month</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < 20; $i++) {
                                        echo "<tr><td>{$cityNames[$i]}</td><td>{$worstMonths[$i]}</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <canvas id="pollutionChart2" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <pre>This chart shows the worst pollution months for various cities, providing insight into seasonal environmental patterns.</pre>
                </div>
            </div>
        </div>
    </div> 
</div>



  
<script>
    // Setting up the bar chart for air quality data
    const ctx = document.getElementById('airQualityChart').getContext('2d');
    const airQualityChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: cityLabels, // City names
            datasets: [{
                label: 'Average Air Quality',
                data: avgData, // Average air quality values
                backgroundColor: 'rgba(54, 162, 235, 0.6)', // Bar color
                borderColor: 'rgba(54, 162, 235, 1)', // Border color
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'City'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Average Air Quality'
                    },
                    beginAtZero: true
                }
            }
        }
    });
</script>


<script>
    // Setting up the line chart for monthly pollution data
    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    const datasets = Object.keys(pollutionData).map(city => {
        const cityData = pollutionData[city].map(entry => entry.pollution);
        return {
            label: city,
            data: cityData,
            fill: false,
            borderColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`,
            tension: 0.1
        };
    });

    const ctx2 = document.getElementById('monthlyPollutionChart').getContext('2d');
    const monthlyPollutionChart = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Average Pollution'
                    },
                    beginAtZero: true
                }
            }
        }
    });
</script>


<script>
    // Setting up the bar chart for air quality data
    const ctx3= document.getElementById('airQualityChart3').getContext('2d');
    const airQualityChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: cityNames, // City names
            datasets: [{
                label: 'Average Air Quality',
                data: avgValues, // Average air quality values
                backgroundColor: 'rgba(54, 162, 235, 0.6)', // Bar color
                borderColor: 'rgba(54, 162, 235, 1)', // Border color
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'City'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Average Air Quality'
                    },
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rank: ' + rankings[context.dataIndex] + ' | Pollution: ' + context.raw;
                        }
                    }
                }
            }
        }
    });
</script>



<script>
    // Setting up the pie chart for pollution data
    const ctx4 = document.getElementById('pollutionChart').getContext('2d');
    const pollutionChart = new Chart(ctx4, {
        type: 'pie',
        data: {
            labels: cityNames, // City names
            datasets: [{
                label: 'Pollution Levels',
                data: avgValues, // Pollution values for each city
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#FF5733', '#B79D62'], // Color for each city segment
                hoverOffset: 4
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
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + ' μg/m³';
                        }
                    }
                }
            }
        }
    });
</script>





<script>
    // Ensure the data is accessible here
    const ctx6 = document.getElementById('pollutionChart2').getContext('2d');
    const pollutionChart2 = new Chart(ctx6, {
        type: 'bar',
        data: {
            labels: cityLabelsPollution, // City names
            datasets: [{
                label: 'Worst Pollution Month',
                data: worstMonthData.map(month => {
                    const monthIndex = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'].indexOf(month);
                    return monthIndex + 1; // Map months to numerical values (1 for January, 2 for February, etc.)
                }),
                backgroundColor: 'rgba(255, 99, 132, 0.6)', // Bar color
                borderColor: 'rgba(255, 99, 132, 1)', // Border color
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'City'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Worst Pollution Month (1=January, 12=December)'
                    },
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        min: 0,
                        max: 12
                    }
                }
            }
        }
    });
</script>

  










</body>

</html>