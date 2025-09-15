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

-- File Name: delete_ticket_handle.php
-- ===================================

-- Selects a ticket with a specific id.
SELECT * FROM tickets WHERE ticket_id = 10;

-- Delete a ticket by ticket_id
DELETE FROM tickets WHERE ticket_id = "3";

-- File Name: fetch_replies.php
-- ============================

-- -- Gets all replies with ticket info
SELECT
    `reply`.*,
    `tickets`.student_reg_number,
    `tickets`.description AS ticket_description
FROM
    `reply`
JOIN
    `tickets` ON reply.ticket_id = `tickets`.ticket_id
ORDER BY
    `reply`.date DESC;

-- File Name: fetch_report.php
-- ===========================

-- Gets counts of students, users and tickets by status
SELECT
    (SELECT COUNT(*) FROM student) AS total_students,
    (SELECT COUNT(*) FROM users) AS total_users,
    (SELECT COUNT(*) FROM tickets) AS total_tickets,
    (SELECT COUNT(*) FROM tickets WHERE status = 'pending') AS pending_tickets,
    (SELECT COUNT(*) FROM tickets WHERE status = 'completed') AS completed_tickets;

-- File Name: auth_check_users.php
-- ===============================

-- Retrieves the username for a specific user id.
SELECT username FROM users WHERE user_id = 3 LIMIT 1;

-- File Name: reply_handle.php
-- ===========================

-- Selects a ticket by its id.
SELECT * FROM tickets WHERE ticket_id = 5;

-- Inserts a new reply into the reply table.
INSERT INTO reply (ticket_id, description, replied_by, date) VALUES ("6", "No", "rushan", NOW());

-- Updates the status of a specific ticket to 'completed'
UPDATE tickets SET status = 'completed' WHERE ticket_id = "6";

-- File Name: fetch_replies_staff.php
-- ==================================

-- Selects replies and ticket details for a specific user.
SELECT
    `reply`.*,
    `tickets`.student_reg_number,
    `tickets`.description AS ticket_description
FROM
    `reply`
JOIN
    `tickets` ON `reply`.ticket_id = `tickets`.ticket_id
WHERE
    `reply`.replied_by = 'hiran'
ORDER BY
    `reply`.date DESC;

-- File Name: fetch_tickets_staff.php
-- ==================================

-- Selects all tickets for the 'Department of Physics' and orders them by date.
SELECT * FROM tickets WHERE department="Department of Physics" ORDER BY date DESC;

-- File Name: update_reply_handle.php
-- ==================================

-- Selects a specific reply.
SELECT * FROM reply WHERE reply_id = "4";

-- Updates the description of the specific reply id.
UPDATE reply SET description = "Yes" WHERE reply_id = "6";

-- File Name: auth_check_students.php
-- ==================================

-- Selects the registration number for a student with an id.
SELECT reg_number FROM student WHERE id = "5" LIMIT 1;

-- File Name: create_ticket_handle.php
-- ===================================

-- Inserts a new ticket with student details, description, department and the current date.
INSERT INTO tickets (student_reg_number, description, department, date) VALUES ("2018s16821", "Insert Query", "ITSC", NOW());

-- File Name: fetch_tickets_students.php
-- =====================================

-- Selects all tickets for a specific student and orders them by date.
SELECT * FROM tickets WHERE student_reg_number = "2018s16821" ORDER BY date DESC;

-- File Name: update_ticket_handle.php
-- ===================================

-- Retrieves a ticket with a specific ID.
SELECT * FROM tickets WHERE ticket_id = "13";

-- Updates the description for a ticket.
UPDATE tickets SET description = "No" WHERE ticket_id = "13";

-- File Name: fetch_replies_students.php
-- =====================================

-- Retrieves all replies associated with a specific student's tickets.
SELECT 
    `reply`.*, 
    `tickets`.student_reg_number, 
    `tickets`.description AS ticket_description 
FROM 
    `reply`
JOIN 
    `tickets` ON `reply`.ticket_id = `tickets`.ticket_id
WHERE 
    `tickets`.student_reg_number = "2018s16821"
ORDER BY 
    `reply`.date DESC;