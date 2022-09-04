-- show cities to which orders have already been delivered.

SELECT DISTINCT `city` FROM `order` WHERE `status` = 4;  


-- show the most expensive product.

SELECT `name`  FROM `product`  ORDER BY `price` DESC LIMIT 1; 


-- show the number of orders, the maximum number in one order and the total number of ordered products.

SELECT COUNT(`id`), MAX(`count`), SUM(`count`) FROM `order`; 


-- show all staff and their positions

SELECT s.name, s.last_name, r.role AS r_role FROM staff s INNER JOIN role r ON s.role = r.id; 


-- show which customer ordered to which city.

SELECT o.city, c.name, c.last_name AS c_name FROM `order` o LEFT OUTER JOIN client c ON o.client = c.id; 


-- show products whose average price is less than 100 (including) and sort alphabetically

SELECT name, AVG(price) AS Avg_price FROM product GROUP BY name HAVING AVG(price) <= 100; 


-- show the product and its price that has been ordered in the largest quantity 

SELECT DISTINCT name, price FROM product WHERE id = (SELECT product FROM `order` WHERE `count` = (SELECT MAX(`count`) FROM `order`)); 

