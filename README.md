This is data visulalization via ETL selectd dataset from https://www.data.gov.in/resources which gives daily base regular commodities for different states

Tech stack we used are 

MySql for database 
HTML,CSS,Chart.js for frontend and visualization
PHP for backend (XAMPP)

the csv file gives dataset we used

in public folder we can see backend,css and chart related folders are respective codes

For initial implementation we executed 2 usecases where we are analyzing cost of commodity among different states and what is their max and min prices in market

For now added onion,tomato,potato,rice in choosing option by default its onion will extend this to remaining commodities and use cases

localhost link : http://localhost/SSD_Project/public/

backend : http://localhost/SSD_Project/public/backend/price.php?commodity=Potato
          http://localhost/SSD_Project/public/backend/market.php?commodity=Potato
