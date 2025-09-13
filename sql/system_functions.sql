-- File Name: login_handle.php
-- ===========================

-- SQL query to find a user with the given username and password.
SELECT * FROM users WHERE username="hiran" AND password="hiran@1970";

-- SQL query to find a student with the given registration number and password.
SELECT * FROM student WHERE reg_number = "2018s16821" AND password = "2018@14321";

-- File Name: register_handle.php
-- ==============================

-- Inserts a new student record into the student table with all required fields.
INSERT INTO student
    (reg_number, index_number, name_with_initials, password, contact_number, town, created_date, updated_date)
VALUES
    ('2023s20250', 's16663', 'C. K. T. Fernando', '2023@16663', '0777143563', 'Kandy', NOW(), NOW());

-- File Name: fetch_students.php
-- =============================

-- Retrieves and orders all records from the 'student' table by ID in ascending order.
SELECT * FROM student ORDER BY id ASC;

-- File Name: update_handle.php
-- ============================

-- Retrieve all information for the student with the specified registration number.
SELECT * FROM student WHERE reg_number = "2023s20371";

-- Update student information for a specific registration number.
UPDATE student SET name_with_initials = "Dissanayake S. M.", town = "Jaffna", contact_number = "0777123456", password = "2018@14321" WHERE reg_number = "2018s16821";

-- File Name: delete_handle.php
-- ============================

-- Fetch student by registration number.
SELECT * FROM student WHERE reg_number = "2020s18073";

-- Remove student by registration number.
DELETE FROM student WHERE reg_number = "2023s20896";

-- File Name: add_user_handle.php
-- ==============================

-- Insert a new user with timestamps.
INSERT INTO users (username, user_type, password, created_at, updated_at) VALUES ("kamindhu", "test", "kamindhu@1956", NOW(), NoW());

-- File Name: fetch_users.php
-- ==========================

-- Sort all user records by user ID in ascending order.
SELECT * FROM users ORDER BY user_id ASC;

-- File Name: update_user_handle.php
-- =================================

-- Select a user record by username.
SELECT * FROM users WHERE username = "hiran";

-- Update the password and user type for the user.
UPDATE users SET password = "kamal@1955", user_type = "Department of Nuclear Science" WHERE username = "Kamal";

-- File Name: delete_user_handle.php
-- =================================

-- Select a user record by username.
SELECT * FROM users WHERE username = "hiran";

-- Delete a user record by username.
DELETE FROM users WHERE username = "kamindhu";

-- File Name: fetch_tickets.php
-- ============================

-- Select all tickets sorted by date in descending order.
SELECT * FROM tickets ORDER BY date DESC;

--