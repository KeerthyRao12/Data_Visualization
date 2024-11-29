<?php include 'data.php'; ?>
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
    <title>Election Data</title>

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
        <h1 class="text-center mb-4">Election Data</h1>

        <h3 class="mb-3">About the Dataset</h3>
        <p class="mb-4">
       This dataset examines the results of the 2024 Indian Parliamentary elections, with a constituency-wise breakdown for each state.  
       </p>
        <p class="mb-4">
            With over 8000 records, it can be a useful tool for dissecting the performances of political parties (both : pan-India and state-wise), and of electoral candidates (constituency-wise).
        </p>

        <h3 class="mb-3">Dataset Columns:</h3>
    </div>

    <div class="container my-5 text-center">
        <button id="toggleButton" class="btn btn-secondary btn-sm mb-3">Show sample</button>

        <div class="table-responsive" id="tableContainer" style="display: none;">
            <table class="table table-bordered table-striped table-sm">
                <thead class="table-dark">
                    <tr>
                        <th class="p-3">State</th>
                        <th class="p-3">Constituency</th>
                        <th class="p-3">Candidate</th>
                        <th class="p-3">Party</th>
                        <th class="p-3">EVM Votes</th>
                        <th class="p-3">Postal Votes</th>
                        <th class="p-3">Total Votes</th>
                        <th class="p-3">Vote Percentage</th>
                        <th class="p-3">Result</th>

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

                    $sample = "SELECT * FROM ElectionResults LIMIT 5;";
                    $rs = mysqli_query($conn, $sample);

                    if ($rs->num_rows > 0) {
                        while ($row = $rs->fetch_assoc()) {
                    ?>
                            <tr>
                                <td class="text-center p-3"><?php echo $row['State']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Constituency']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Candidate']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Party']; ?></td>
                                <td class="text-center p-3"><?php echo $row['EVM_Votes']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Postal_Votes']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Total_Votes']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Vote_Percentage']; ?></td>
                                <td class="text-center p-3"><?php echo $row['Result']; ?></td>
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
            Chart 1: Party Results by State
        </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <?php
            // Include the PHP file that fetches party results data
            include 'c1.php'; // This should set $stateLabels, $partyLabels, and $winsData
            ?>
            <div class="container my-2">
                <div class="row">
                    <!-- Left column for the table -->
                    <div class="col-md-6">
                        <div class="table-responsive" style="max-height: 3000px; overflow-y: auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>State</th>
                                        <th>Party</th>
                                        <th>Wins</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Display the data in the table
                                    for ($i = 0; $i < count($stateLabels); $i++) {
                                        echo "<tr>
                                            <td>{$stateLabels[$i]}</td>
                                            <td>{$partyLabels[$i]}</td>
                                            <td>{$winsData[$i]}</td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Right column for the chart -->
                    <div class="col-md-6">
                        <canvas id="partyResultsChart" width="700" height="2000"></canvas>
                    </div>
                </div>
                <pre>This chart shows the number of wins for each party, grouped by state. It provides an overview of the election performance across various regions.</pre>
            </div>
        </div>
    </div>
</div>

    </div>











    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
        // Assuming the data is being passed from PHP into JavaScript
        const stateLabels = <?php echo json_encode($stateLabels); ?>;
        const partyLabels = <?php echo json_encode($partyLabels); ?>;
        const winsData = <?php echo json_encode($winsData); ?>;

        // Log the data to verify structure
        console.log('State Labels:', stateLabels);
        console.log('Party Labels:', partyLabels);
        console.log('Wins Data:', winsData);

        // Initialize datasets array if not already defined
        let datasets = [];

        // Group data by state and party
        const groupedData = {};
        for (let i = 0; i < stateLabels.length; i++) {
            const state = stateLabels[i];
            const party = partyLabels[i];
            const wins = winsData[i];

            if (!groupedData[state]) {
                groupedData[state] = {};
            }

            groupedData[state][party] = { wins };
        }

        // Prepare the dataset for each political party
        const parties = [...new Set(partyLabels)];

        parties.forEach((party) => {
            const wins = [];
            Object.keys(groupedData).forEach((state) => {
                const stateData = groupedData[state][party];
                if (stateData) {
                    wins.push(stateData.wins);
                } else {
                    wins.push(0); // No data for this party in this state
                }
            });

            // Add dataset for wins (using the party name as the label)
            datasets.push({
                label: party,  // The party name will appear in the legend
                data: wins, // The wins data
                backgroundColor: getRandomColor(), // Random color for each party
                borderColor: '#fff',  // White border color for the bars
                borderWidth: 1,  // Border width for the bars
                stack: 'wins' // Stack the bars for each party
            });
        });

        // Initialize the chart
        const ctx = document.getElementById('partyResultsChart').getContext('2d');
        const partyResultsChart = new Chart(ctx, {
            type: 'bar', // Bar chart type
            data: {
                labels: Object.keys(groupedData), // X-axis labels (states)
                datasets: datasets // Y-axis data (wins by party)
            },
            options: {
                responsive: true,
                indexAxis: 'x', // X-axis for states and Y-axis for parties
                title: {
                    display: true,
                    text: 'Political Party Results by State',
                    fontSize: 16,
                    fontWeight: 'bold'
                },
                scales: {
                    x: {
                        stacked: true, // Stack the bars on the X-axis
                        beginAtZero: true, // Ensure the scale starts at zero
                        type: 'category', // Set X-axis to 'category' for categorical data (states)
                        title: {
                            display: true,
                            text: 'States' // Label for the X-axis
                        },
                        grid: {
                            offset: true // Adjust grid to align properly with stacked bars
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Count of Wins' // Label for the Y-axis (total count of wins for each party)
                        },
                        beginAtZero: true, // Ensure the scale starts at zero
                        stacked: true, // Stack the bars for each party on the Y-axis
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
                        position: 'top', // Position the legend at the top
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.dataset.label}: ${tooltipItem.raw} votes`; // Format the tooltip to show party and count
                            }
                        }
                    }
                }
            }
        });
    });

    // Utility function to generate random color for each dataset
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    
</script>

</body>

</html>