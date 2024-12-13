<?php
session_start();
$conn = new mysqli("localhost", "root", "Piriyah@110599", "Lab_5b");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .status-container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
        }
        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #007bff;
        }
        h2 {
            color: #e74c3c;
        }
        p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #555;
        }
        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .success {
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-top: 30px;
        }
        .error {
            background-color: #dc3545;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<?php
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        // Set session variables for a successful login
        $_SESSION['logged_in'] = true;
        $_SESSION['user_name'] = $user['name'];
        
        // Display success message
        echo "
        <div class='status-container'>
            <h1>Login Successful!</h1>
            <p>Welcome back, <strong>{$_SESSION['user_name']}</strong>! You have successfully logged in.</p>
            <div class='success'>
                <p>Redirecting you to the dashboard...</p>
                <a href='display.php' class='btn'>Go to Dashboard</a>
            </div>
        </div>
        ";
        // Redirect to display.php after a few seconds
        header("refresh:3;url=display.php");
        exit();
    } else {
        // Display error message for invalid password
        echo "
        <div class='status-container'>
            <h2>Invalid Password</h2>
            <p>Oops! The password you entered is incorrect. Please try again.</p>
            <div class='error'>
                <a href='login.php' class='btn'>Go Back to Login</a>
            </div>
        </div>
        ";
    }
} else {
    // Display error message for invalid username
    echo "
    <div class='status-container'>
        <h2>Invalid Username</h2>
        <p>Oops! We couldn't find your account. Please check your email or try again.</p>
        <div class='error'>
            <a href='login.php' class='btn'>Go Back to Login</a>
        </div>
    </div>
    ";
}

$conn->close();
?>

</body>
</html>
    