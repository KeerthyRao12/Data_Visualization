-- create database testingdb;
-- use testingdb;

-- main database table
CREATE TABLE air_quality (
    ranki INT,
    city VARCHAR(50),
    city_name VARCHAR(50),
    country VARCHAR(50),
    avg INT,
    jan FLOAT,
    feb FLOAT,
    mar FLOAT,
    apr FLOAT,
    may FLOAT,
    jun FLOAT,
    jul FLOAT,
    aug FLOAT,
    sep FLOAT,
    oct FLOAT,
    nov FLOAT,
    dece FLOAT
);

LOAD DATA INFILE '/var/lib/mysql-files/aqi.csv'
INTO TABLE air_quality
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(ranki, city, city_name, country, avg, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece);


-- reporting table for monthly_pollution_for_city
CREATE TABLE monthly_pollution_for_city (
    id INT AUTO_INCREMENT PRIMARY KEY,   -- Unique identifier for each record
    city_name VARCHAR(255) NOT NULL,     -- Name of the city
    country VARCHAR(255) NOT NULL,       -- Name of the country
    month VARCHAR(20) NOT NULL,          -- Month (e.g., 'Jan', 'Feb', etc.)
    avg_pollution DECIMAL(10, 2) NOT NULL -- Average pollution value for the given month
);

-- Report table for top cities with highest average pollution
CREATE TABLE top_cities_pollution (
    ranki INT,
    city_name VARCHAR(255),
    country VARCHAR(255),
    avg_pollution DECIMAL(10, 2)
);

-- reporting table for WorstPollutionMonths
CREATE TABLE WorstPollutionMonths (
    City VARCHAR(255),
    WorstMonth VARCHAR(20)
);



-- procedures
-- for table monthly_pollution_for_city
DELIMITER $$

CREATE PROCEDURE generate_monthly_pollution_for_city_report()
BEGIN
    -- Clear the existing data in the reporting table
    TRUNCATE TABLE monthly_pollution_for_city;

    -- Insert the monthly pollution data for the specified cities into the reporting table
    INSERT INTO monthly_pollution_for_city (city_name, country, month, avg_pollution)
    SELECT city_name, country, 'Jan', jan FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Feb', feb FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Mar', mar FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Apr', apr FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'May', may FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Jun', jun FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Jul', jul FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Aug', aug FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Sep', sep FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Oct', oct FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Nov', nov FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow')
    UNION
    SELECT city_name, country, 'Dec', dece FROM air_quality WHERE city_name IN ('Begusarai', 'New Delhi', 'Noida', 'Patna', 'Lucknow');
END$$

DELIMITER ;

call generate_monthly_pollution_for_city_report();

-- end1


-- for top_cities_pollution
DELIMITER $$

CREATE PROCEDURE generate_top_cities_pollution_report()
BEGIN
    -- Clear the existing data in the reporting table
    TRUNCATE TABLE top_cities_pollution;

    -- Insert the top cities with highest average pollution into the reporting table
    INSERT INTO top_cities_pollution (ranki, city_name, country, avg_pollution)
    SELECT ranki, city_name, country, avg
    FROM air_quality
    ORDER BY avg DESC
    LIMIT 50;  -- Limit to top 10 cities
END$$

DELIMITER ;

call generate_top_cities_pollution_report();
-- end


-- for WorstPollutionMonths
DELIMITER //

CREATE PROCEDURE GetWorstPollutionMonthPerCity() 
BEGIN 
    -- Clear the table before inserting fresh results 
    TRUNCATE TABLE WorstPollutionMonths;

    -- Insert the worst pollution month for each city 
    INSERT INTO WorstPollutionMonths (City, WorstMonth)
    WITH CityWorstMonth AS (
        SELECT 
            city,
            CASE 
                WHEN jan = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'January'
                WHEN feb = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'February'
                WHEN mar = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'March'
                WHEN apr = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'April'
                WHEN may = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'May'
                WHEN jun = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'June'
                WHEN jul = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'July'
                WHEN aug = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'August'
                WHEN sep = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'September'
                WHEN oct = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'October'
                WHEN nov = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'November'
                WHEN dece = GREATEST(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece) THEN 'December'
            END AS WorstMonth
        FROM (
            SELECT DISTINCT city, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dece
            FROM air_qualityWorstPollutionMonths
        ) AS UniqueRows
    )
    SELECT city, WorstMonth
    FROM CityWorstMonth
    WHERE WorstMonth IS NOT NULL;
END //

DELIMITER ;

call GetWorstPollutionMonthPerCity();
 -- end
 
 
 
 

 

