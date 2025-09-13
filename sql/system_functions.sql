-- File Name: login_handle.php
-- ===========================

-- Purpose: SQL query to find a user with the given username and password
SELECT * FROM users WHERE username="hiran" AND password="hiran@1970";

--Purpose: SQL query to find a student with the given registration number and password
SELECT * FROM student WHERE reg_number = "2018s16821" AND password = "2018@14321";

-- File Name: register_handle.php
-- ==============================

-- Purpose: Inserts a new student record into the student table with all required fields.
INSERT INTO student
    (reg_number, index_number, name_with_initials, password, contact_number, town, created_date, updated_date)
VALUES
    ('2023s20250', 's16663', 'C. K. T. Fernando', '2023@16663', '0777143563', 'Kandy', NOW(), NOW());

-- File Name: fetch_students.php
-- =============================

-- Purpose: Retrieves and orders all records from the 'student' table by ID in ascending order.
SELECT * FROM student ORDER BY id ASC;

-- File Name: update_handle.php
-- ============================

-- Purpose: Retrieve all information for the student with the specified registration number.
SELECT * FROM student WHERE reg_number = "2023s20371";

-- Purpose: Update student information for a specific registration number.
UPDATE student SET name_with_initials = "Dissanayake S. M.", town = "Jaffna", contact_number = "0777123456", password = "2018@14321" WHERE reg_number = "2018s16821";