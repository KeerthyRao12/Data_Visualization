<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commodities from Various Markets (Mandi)</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 0.25rem;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .table th, .table td {
            vertical-align: middle;
            padding: 12px;
        }

        .table-dark {
            background-color: #343a40;
            color: white;
        }

        .container {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <!-- Container for the Content -->
    <div class="container my-5">
        <h1 class="text-center mb-4">Current Daily Price of Various Commodities from Various Markets (Mandi)</h1>

        <!-- Dataset Introduction Section -->
        <div class="intro-section mb-5">
            <p><strong>Dataset Overview:</strong> The data refers to prices of various commodities. It has the wholesale maximum price, minimum price and modal price on daily basis. This dataset is generated through the AGMARKNET Portal, which disseminates daily market information of various commodities.</p>
            <p><strong>Columns in the Dataset:</strong></p>
            <ul>
                <li><strong>State:</strong> The state in which the market is located.</li>
                <li><strong>District:</strong> The district within the state where the market is located.</li>
                <li><strong>Market:</strong> The specific market where the commodity is being traded.</li>
                <li><strong>Commodity:</strong> The commodity being traded (e.g., wheat, rice, etc.).</li>
                <li><strong>Variety:</strong> The variety of the commodity.</li>
                <li><strong>Grade:</strong> The grade classification of the commodity.</li>
                <li><strong>Min_Price:</strong> The minimum price at which the commodity is being sold.</li>
                <li><strong>Max_Price:</strong> The maximum price at which the commodity is being sold.</li>
                <li><strong>Modal_Price:</strong> The most frequently observed price in the market for the commodity.</li>
            </ul>
        </div>

        <!-- Sample Data Section -->
        <h3 class="mb-3">Sample Data from main dataset</h3>
        <button id="toggleButton" class="btn btn-secondary btn-sm mb-3">Show Sample</button>

        <div class="table-responsive" id="tableContainer" style="display: none;">
            <table class="table table-bordered table-striped table-sm">
                <thead class="table-dark">
                    <tr>
                        <th class="p-3">State</th>
                        <th class="p-3">District</th>
                        <th class="p-3">Market</th>
                        <th class="p-3">Commodity</th>
                        <th class="p-3">Variety</th>
                        <th class="p-3">Grade</th>
                        <th class="p-3">Min_Price</th>
                        <th class="p-3">Max_Price</th>
                        <th class="p-3">Modal_Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $conn = new mysqli('localhost', 'root', 'Sam@1357912', 'ssd_project');
                    $query = "SELECT * FROM prices_commodities LIMIT 10"; // Sample 5 rows
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['State']."</td>";
                        echo "<td>".$row['District']."</td>";
                        echo "<td>".$row['Market']."</td>";
                        echo "<td>".$row['Commodity']."</td>";
                        echo "<td>".$row['Variety']."</td>";
                        echo "<td>".$row['Grade']."</td>";
                        echo "<td>".$row['Min_Price']."</td>";
                        echo "<td>".$row['Max_Price']."</td>";
                        echo "<td>".$row['Modal_Price']."</td>";
                        echo "</tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container my-5">
            <h3>Select a State</h3>
            <select id="stateSelect" class="form-select" aria-label="Select a State">
                <option value="">Select a State</option>
                <?php
                // Fetch distinct states from the database
                $conn = new mysqli('localhost', 'root', 'Sam@1357912', 'ssd_project');
                $query = "SELECT DISTINCT State FROM prices_commodities";
                $result = $conn->query($query);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['State']."'>".$row['State']."</option>";
                    }
                } else {
                    echo "<option>No states found</option>";
                }
                $conn->close();
                ?>
            </select>
        </div>
    <!-- Commodity Selection Dropdown -->
    <div class="container my-5">
        <h3>Select a Commodity</h3>
        <select id="commoditySelect" class="form-select" aria-label="Select a Commodity">
            <option value="">Select a Commodity</option>
            <?php
            // Fetch distinct commodities from the database
            $conn = new mysqli('localhost', 'root', 'Sam@1357912', 'ssd_project');
            $query = "SELECT DISTINCT Commodity FROM prices_commodities";
            $result = $conn->query($query);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['Commodity']."'>".$row['Commodity']."</option>";
                }
            } else {
                echo "<option>No commodities found</option>";
            }
            $conn->close();
            ?>
        </select>
    </div>

    <!-- Data Visualization Section -->
    <div class="container my-5">
        <h2>Data Visualization</h2>
        <div class="accordion container my-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Chart 1: Average prices across states
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="container my-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>States</th>
                                                <th>Avg Prices</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableData">
                                            <!-- States and Avg Prices table will be dynamically populated -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="priceChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        </div>
               <!-- Chart 2: Market Volatility (Max & Min Prices) -->
               <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Chart 2: Market volatility for commodity
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="container m-2">
                            <div class="row">
                                <!-- Left column for the table -->
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Minimum Price</th>
                                                <th>Maximum Price</th>
                                            </tr>
                                        </thead>
                                        <tbody id="volatilityTableData">
                                            <!-- Min and Max prices will be dynamically populated -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="marketChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        </div>
                    <div class="accordion-item">
                   <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Chart 3: CPI for selected commodity with other commodities
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                 

                    <div class="container m-2">
                        
                        <div class="row">
                            
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>Commodity</th>
                                        <th>CPI</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody id="cpiTableData">
                                    </tbody>
                                </table>
                            </div>

                            <!-- Right column for the chart -->
                            <div class="col-md-6">
                                <canvas id="cpiChart" width="400" height="200"></canvas>
                            </div>
                </div>
            </div>
    
    </div>
        </div>
        </div>
    <div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Chart 4: Price Differences Across Districts
        </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="container m-2">
                <div class="row">
                    <!-- Left column for the table -->
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>District</th>
                                    <th>Average Price</th>
                                </tr>
                            </thead>
                            <tbody id="districtPriceTable">
                                <!-- District and Average Price data will be dynamically populated -->
                            </tbody>
                        </table>
                    </div>
                    <!-- Right column for the radar chart -->
                    <div class="col-md-6">
                        <canvas id="priceRadarChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <h2 class="accordion-header">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBubbleChart" aria-expanded="false" aria-controls="collapseBubbleChart">
        Chart 5: Highest Price at Market Level for Selected Commodity
    </button>
</h2>
<div id="collapseBubbleChart" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
    <div class="accordion-body">
        <div class="container m-2">
            <div class="row">
                <!-- Left column for the table -->
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Market</th>
                                <th>Highest Price</th>
                            </tr>
                        </thead>
                        <tbody id="marketPriceTable">
                            <!-- Market and Highest Price data will be dynamically populated -->
                        </tbody>
                    </table>
                </div>
                <!-- Right column for the pie chart -->
                <div class="col-md-6">
                    <canvas id="pricePieChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>


    
    <script>
        document.getElementById("toggleButton").addEventListener("click", function() {
            var tableContainer = document.getElementById("tableContainer");
            var buttonText = document.getElementById("toggleButton");

            if (tableContainer.style.display === "none") {
                tableContainer.style.display = "block";
                buttonText.textContent = "Hide sample";
            } else {
                tableContainer.style.display = "none";
                buttonText.textContent = "Show sample";
            }
        });

        document.getElementById('commoditySelect').addEventListener('change', function() {
            const selectedCommodity = this.value;

            if (selectedCommodity) {
                // Fetch the data from price.php
                fetch(`price.php?commodity=${selectedCommodity}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.states && data.avgPrices) {
                            const tableBody = document.querySelector('#tableData');
                            tableBody.innerHTML = '';  // Clear existing table data

                            // Populate the table with the fetched data
                            for (let i = 0; i < data.states.length; i++) {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td class="text-center">${data.states[i]}</td>
                                    <td class="text-center">${data.avgPrices[i]}</td>
                                `;
                                tableBody.appendChild(row);
                            }

                            // Destroy the existing chart if it exists
                            if (window.priceChart && window.priceChart.destroy) {
                                window.priceChart.destroy();
                            }

                            // Create the chart with the new data
                            const ctx = document.getElementById('priceChart').getContext('2d');
                            window.priceChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: data.states,
                                    datasets: [{
                                        label: 'Avg Prices',
                                        data: data.avgPrices,
                                        backgroundColor: '#007bff',
                                        borderColor: '#0056b3',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                        tooltip: {
                                            enabled: true,
                                        },
                                    },
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'States'
                                            }
                                        },
                                        y: {
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Avg Price'
                                            }
                                        }
                                    }
                                }
                            });
                        }
                    })
                    .catch(error => console.log(error));
            }
        });
        document.getElementById('commoditySelect').addEventListener('change', function() {
            const selectedCommodity = this.value;

            if (selectedCommodity) {
                fetch(`market.php?commodity=${selectedCommodity}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.minPrice !== undefined && data.maxPrice !== undefined) {
                            // Update the volatility table
                            const volatilityTableData = document.querySelector('#volatilityTableData');
                            volatilityTableData.innerHTML = `
                                <tr><td>₹${data.minPrice}</td><td>₹${data.maxPrice}</td></tr>
                            `;
                            if (window.marketChart instanceof Chart) {
                                window.marketChart.destroy();
                            }
                            // Create Chart 2: Market volatility
                            const ctx2 = document.getElementById('marketChart').getContext('2d');
                            window.marketChart=new Chart(ctx2, {
                                type: 'bar',
                                data: {
                                    labels: ['Min Price', 'Max Price'],
                                    datasets: [{
                                        label: 'Market Volatility',
                                        data: [data.minPrice, data.maxPrice],
                                        backgroundColor: ['rgba(54, 162, 235, 0.6)', 'rgba(255, 99, 132, 0.6)'],
                                        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                                        borderWidth: 1
                                    }]
                                }
                            });
                        }
                    });
            }
        });

        document.getElementById('commoditySelect').addEventListener('change', function () {
    const selectedCommodity = this.value;
    if (!selectedCommodity) return;

    // Fetch CPI data for the selected commodity and others
    fetch(`cpi.php?commodity=${selectedCommodity}`)
        .then(response => response.json())
        .then(data => {
            // Populate the table with CPI data for all commodities
            const cpiTable = document.getElementById('cpiTableData');
            cpiTable.innerHTML = ''; // Clear the existing table data

            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.commodity}</td>
                    <td>${item.cpi}</td>
                `;
                cpiTable.appendChild(row);
            });

            // Prepare data for the chart
            const labels = data.map(item => item.commodity);
            const cpiValues = data.map(item => item.cpi);
            const borderColors = data.map(item =>
                item.is_selected ? 'rgba(255, 99, 132, 1)' : 'rgba(75, 192, 192, 1)'
            );
            const pointBackgroundColors = data.map(item =>
                item.is_selected ? 'rgba(255, 99, 132, 0.8)' : 'rgba(75, 192, 192, 0.8)'
            );

            // Update the line chart
            const ctx = document.getElementById('cpiChart').getContext('2d');

            // Check and destroy the previous chart if it exists
            if (window.cpiChart instanceof Chart) {
                window.cpiChart.destroy();
            }

            // Create a new line chart
            window.cpiChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'CPI Index',
                        data: cpiValues,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        pointBorderColor: borderColors,
                        pointBackgroundColor: pointBackgroundColors,
                        pointBorderWidth: 2,
                        pointRadius: data.map(item => (item.is_selected ? 6 : 4)),
                        fill: false,
                        tension: 0.2 // Smooth curves
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return `CPI: ${tooltipItem.raw}`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Commodities'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'CPI Index'
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching CPI data:', error));
});
document.getElementById('commoditySelect').addEventListener('change', function() {
    const selectedCommodity = this.value;
    const selectedState = document.getElementById('stateSelect').value;
    
    if (!selectedCommodity || !selectedState) return;

    // Fetch price data for the selected commodity and state
    fetch(`district.php?state=${selectedState}&commodity=${selectedCommodity}`)
        .then(response => response.json())
        .then(data => {
            // Prepare data for Radar Chart
            const districts = data.map(item => item.District);
            const prices = data.map(item => item.Average_Price);

            // Populate the data table dynamically
            const tableBody = document.getElementById('districtPriceTable');
            tableBody.innerHTML = ''; // Clear existing table rows
            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${item.District}</td><td>₹${item.Average_Price}</td>`;
                tableBody.appendChild(row);
            });
            

            // Create Radar Chart
            const ctx = document.getElementById('priceRadarChart').getContext('2d');
            const radarChartData = {
                labels: districts,
                datasets: [{
                    label: `Price differences for ${selectedCommodity}`,
                    data: prices,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            };

            if (window.priceRadarChart instanceof Chart) {
                window.priceRadarChart.destroy();
            }

            window.priceRadarChart = new Chart(ctx, {
                type: 'radar',
                data: radarChartData,
                options: {
                    scales: {
                        r: {
                            angleLines: {
                                display: true
                            },
                            suggestedMin: 0
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching price data:', error));
});
document.getElementById('commoditySelect').addEventListener('change', function () {
    const commodity = 'Wheat';  // Replace with selected commodity
    fetch(`marketHighestPrices.php?commodity=${commodity}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error:', data.error);
                return;
            }

            // Populate the table with fetched market data
            const marketTable = document.getElementById('marketPriceTable');
            marketTable.innerHTML = '';  // Clear previous table content
            data.marketData.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${item.market}</td><td>${item.max_price}</td>`;
                marketTable.appendChild(row);
            });

            // Prepare Pie Chart data
            const chartLabels = data.marketData.map(item => item.market);
            const chartData = data.marketData.map(item => item.max_price);

            // Create Pie Chart using Chart.js
            const ctx = document.getElementById('pricePieChart').getContext('2d');
            if (window.pricePieChart instanceof Chart) {
                window.pricePieChart.destroy(); // Destroy the old chart if it exists
            }

            window.pricePieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Highest Price at Market Level',
                        data: chartData,
                        backgroundColor: ['rgba(0, 123, 255, 0.6)', 'rgba(0, 255, 0, 0.6)', 'rgba(255, 0, 0, 0.6)', 'rgba(255, 165, 0, 0.6)'],  // Pie slice colors
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
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
                                label: function (tooltipItem) {
                                    return `${tooltipItem.label}: $${tooltipItem.raw}`;
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching market data:', error));
});




</script>



    </script>
</body>

</html>
