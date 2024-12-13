<?php
// Establish a connection to the database
$conn = new mysqli("localhost", "root", "Piriyah@110599", "Lab_5b");

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Exit if connection fails
}

// Retrieve the POST data from the form
$matric = $_POST['matric'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security
$accessLevel = $_POST['accessLevel'];

// SQL query to insert the new user into the 'users' table
$sql = "INSERT INTO users (matric, name, email, password, accessLevel) VALUES ('$matric', '$name', '$email', '$password', '$accessLevel')";

// Check if the query was successful and provide feedback
if ($conn->query($sql) === TRUE) {
    // Successful registration message
    echo "<div class='success-message'>
            <h2>Registration Successful!</h2>
            <p>Your account has been created successfully. You can now <a href='login.php'>login</a>.</p>
          </div>";
} else {
    // Error message in case of failure
    echo "<div class='error-message'>
            <h2>Error</h2>
            <p>There was an error during the registration process. Please try again later.</p>
          </div>";
}

// Close the database connection
$conn->close();
?>

<!-- HTML structure for the success and error messages -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Status</title>
    <style>
        /* Global reset */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        /* Main container to center content */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full screen height */
            background-color: #f4f4f9;
        }

        /* Styling for the success message */
        .success-message {
            background-color: #28a745;
            color: white;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            width: 80%;
            max-width: 500px; /* Set max width for better responsiveness */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            font-size: 18px;
        }

        .success-message h2 {
            font-size: 26px;
            margin: 0;
            padding-bottom: 10px;
        }

        .success-message p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .success-message a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .success-message a:hover {
            background-color: #0056b3;
            text-decoration: underline;
        }

        /* Styling for the error message */
        .error-message {
            background-color: #dc3545;
            color: white;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            font-size: 18px;
        }

        .error-message h2 {
            font-size: 26px;
            margin: 0;
            padding-bottom: 10px;
        }

        .error-message p {
            font-size: 16px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- The success or error message will be displayed here -->
    </div>
</body>
</html>
