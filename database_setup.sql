-- --------------------------------------------------------
-- Tiny College VMDB Database Setup Script
-- --------------------------------------------------------
-- This script creates the necessary tables and inserts sample data
-- for the Tiny College Vehicle Management Database (VMDB) project.
--
-- Instructions:
-- 1. Create a new MySQL database named 'tiny_college_vmdb'
-- 2. Run this script in phpMyAdmin or using the MySQL command line:
--    mysql -u username -p tiny_college_vmdb < database_setup.sql
--
-- Tables created:
-- - department: Stores academic departments
-- - faculty: Stores faculty member information
--
-- Sample data is inserted for testing and demonstration purposes.
-- --------------------------------------------------------

-- Create department table
CREATE TABLE department (
    DEPARTMENT_CODE VARCHAR(10) PRIMARY KEY,
    DEPARTMENT_NAME VARCHAR(100) NOT NULL
);

-- Create faculty table
CREATE TABLE faculty (
    FACULTY_ID INT AUTO_INCREMENT PRIMARY KEY,
    FACULTY_FNAME VARCHAR(50) NOT NULL,
    FACULTY_LNAME VARCHAR(50) NOT NULL,
    FACULTY_EMAIL VARCHAR(100),
    DEPARTMENT_CODE VARCHAR(10),
    FOREIGN KEY (DEPARTMENT_CODE) REFERENCES department(DEPARTMENT_CODE)
);

-- Insert sample data
INSERT INTO department (DEPARTMENT_CODE, DEPARTMENT_NAME) VALUES
('CS', 'Computer Science'),
('ENG', 'Engineering'),
('MATH', 'Mathematics'),
('BUS', 'Business');

INSERT INTO faculty (FACULTY_FNAME, FACULTY_LNAME, FACULTY_EMAIL, DEPARTMENT_CODE) VALUES
('John', 'Smith', 'jsmith@tinycollege.edu', 'CS'),
('Mary', 'Johnson', 'mjohnson@tinycollege.edu', 'ENG'),
('Robert', 'Williams', 'rwilliams@tinycollege.edu', 'MATH');