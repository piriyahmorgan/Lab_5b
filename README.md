User Management System
A PHP and MySQL-based web application for managing user accounts, featuring secure registration, login, and CRUD operations. This project supports role-based access for Students and Lecturers.

Features
- User registration and secure login.
- Update and delete user data (CRUD operations).
- Role-based access (Student/Lecturer).
- Passwords hashed securely with bcrypt.

Technologies Used
- PHP
- MySQL
- HTML/CSS
- JavaScript
- Setup Instructions
  
Clone the repository:
git clone https://github.com/your-username/user-management-system.git

Navigate to the project folder:
cd user-management-system

Set up the database:
Create a MySQL database named Lab_5b.
Import the provided Lab_5b.sql file to set up tables.
Configure the database connection in the config.php file:

php
Copy code
$conn = new mysqli("localhost", "your-username", "your-password", "Lab_5b");

Start the server:
Using XAMPP or a similar tool, place the project folder in the htdocs directory.
Access the application via http://localhost/user-management-system.

Usage
- Register a new user.
- Log in using valid credentials.
- Manage user information with update and delete functionalities
