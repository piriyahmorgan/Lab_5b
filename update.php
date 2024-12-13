<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "Piriyah@110599", "Lab_5b");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user data to pre-fill the form
    $result = $conn->query("SELECT * FROM users WHERE id = '$id'");
    $row = $result->fetch_assoc();

    // Check if 'level' exists in the result
    $level = isset($row['level']) ? $row['level'] : ''; // Default to an empty string if 'level' is not set
    $matric = isset($row['matric']) ? $row['matric'] : ''; // Get matric number from database

    // Handle form submission for updating data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $matric = $_POST['matric']; // Get the updated matric number
        $level = $_POST['level'];

        // Update query
        $conn->query("UPDATE users SET name = '$name', matric = '$matric', level = '$level' WHERE id = '$id'");
        header("Location: display.php"); // Redirect after update
    }
} else {
    echo "No record found.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #007BFF;
            margin-top: 30px;
        }
        form {
            width: 40%;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"], .delete-button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }
        input[type="submit"]:hover, .delete-button:hover {
            opacity: 0.8;
        }
        .delete-button {
            background-color: #dc3545;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h1>Update User</h1>

<form method="POST">
    <!-- Matric Number Input -->
    <label for="matric">Matric Number:</label>
    <input type="text" name="matric" id="matric" value="<?php echo htmlspecialchars($matric); ?>" required>
    
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
    
    <label for="level">Level:</label>
    <select name="level" id="level" required>
        <option value="Student" <?php echo ($level == 'Student') ? 'selected' : ''; ?>>Student</option>
        <option value="Lecturer" <?php echo ($level == 'Lecturer') ? 'selected' : ''; ?>>Lecturer</option>
    </select>

    <input type="submit" value="Update">
</form>

<!-- Delete User Button -->
<form action="delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <button type="submit" class="delete-button">Delete User</button>
</form>

</body>
</html>

<?php
$conn->close();
?>
