<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Registration Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #007BFF;
        }
        form {
            max-width: 400px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #007BFF;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Register</h1>
    <form action="register_process.php" method="post">
        <label>Matric Number:</label>
        <input type="text" name="matric" required>
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <label>Access Level:</label>
        <select name="accessLevel" required>
            <option value="Lecturer">Lecturer</option>
            <option value="Student">Student</option>
        </select>
        <button type="submit">Register</button>
    </form>
</body>
</html>

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
?>

