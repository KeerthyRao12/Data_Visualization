document.addEventListener('DOMContentLoaded', (event) => {
    let priceTrendsChart = null; 
    let volatilityChart = null;
    function updateCharts(commodity) {
        if (priceTrendsChart !== null) {
            priceTrendsChart.destroy();
        }
        const ctxPriceTrends = document.getElementById('myChart').getContext('2d');
        priceTrendsChart = new Chart(ctxPriceTrends, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: `Price of ${commodity}`,
                    data: [],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        fetch(`./backend/price.php?commodity=${commodity}`)
          .then(response => {
              if (!response.ok) {
                  throw new Error('Network response was not ok ' + response.statusText);
              }
              return response.json();
          })
          .then(data => {
              const states = data.map(item => item.State);
              const prices = data.map(item => item.Modal_Price);
              priceTrendsChart.data.labels = states;
              priceTrendsChart.data.datasets[0].data = prices;
              priceTrendsChart.update();
          })
          .catch(error => console.error('Error fetching price trends:', error));
        fetch(`./backend/market.php?commodity=${commodity}`)
          .then(response => response.json())
          .then(data => {
              if (volatilityChart !== null) {
                  volatilityChart.destroy();
              }
  
              const ctxVolatility = document.getElementById('volatilityChart').getContext('2d');
              volatilityChart = new Chart(ctxVolatility, {
                  type: 'bar',
                  data: {
                      labels: ['Max Price', 'Min Price'],
                      datasets: [{
                          label: `Market Volatility for ${commodity}`,
                          data: [data.maxPrice, data.minPrice],
                          backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                          borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
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
          })
          .catch(error => console.error('Error fetching volatility:', error));
    }
    let commodity = 'Onion';
    updateCharts(commodity);
    const commoditySelect = document.getElementById('commoditySelect');
    commoditySelect.addEventListener('change', (event) => {
        commodity = event.target.value;
        updateCharts(commodity); 
    });
  
  });
  