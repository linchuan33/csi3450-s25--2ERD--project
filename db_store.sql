-- Create the database
CREATE DATABASE IF NOT EXISTS db_store;

-- Use the created database
USE db_store;

-- Create the table
CREATE TABLE products (
    pro_id INT PRIMARY KEY,
    pro_cost DECIMAL(10, 2),
    pro_description VARCHAR(255)
);

-- Insert 20 rows with random data
INSERT INTO products (pro_id, pro_cost, pro_description) VALUES
(1, 10.99, 'Product description 1'),
(2, 15.49, 'Product description 2'),
(3, 7.25, 'Product description 3'),
(4, 22.35, 'Product description 4'),
(5, 18.99, 'Product description 5'),
(6, 5.50, 'Product description 6'),
(7, 12.75, 'Product description 7'),
(8, 9.99, 'Product description 8'),
(9, 14.85, 'Product description 9'),
(10, 20.00, 'Product description 10'),
(11, 11.95, 'Product description 11'),
(12, 16.40, 'Product description 12'),
(13, 8.30, 'Product description 13'),
(14, 25.00, 'Product description 14'),
(15, 13.75, 'Product description 15'),
(16, 6.99, 'Product description 16'),
(17, 19.50, 'Product description 17'),
(18, 10.00, 'Product description 18'),
(19, 17.80, 'Product description 19'),
(20, 14.25, 'Product description 20');
