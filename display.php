<?php
// Start the session to check for login status
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['logged_in'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit(); // Ensure the script stops executing
}

// Establish a connection to the database
$conn = new mysqli("localhost", "root", "Piriyah@110599", "Lab_5b");

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Display error if connection fails
}

// SQL query to fetch user data from the 'users' table
$sql = "SELECT id, matric, name, accessLevel FROM users";
$result = $conn->query($sql); // Execute the query and store the result
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <style>
        /* Basic styling for the page */
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
            margin-top: 30px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        td a {
            color: #007BFF;
            text-decoration: none;
            padding: 5px;
        }
        td a:hover {
            text-decoration: underline;
        }
        /* Styling for action buttons */
        .action-buttons {
            text-align: center;
        }
        .action-buttons button {
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .action-buttons button.delete {
            background-color: #dc3545;
        }
        .action-buttons button:hover {
            opacity: 0.8;
        }
    </style>
    <script>
        // JavaScript function to confirm before deleting a user
        function confirmDelete() {
            // Display a confirmation dialog box
            return confirm("Are you sure you want to delete this user?");
        }
    </script>
</head>
<body>
    <h1>User Data</h1>
    <!-- Display the user data in a table -->
    <table>
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Access Level</th>
            <th>Action</th>
        </tr>
        <!-- Loop through the result set and display each user in a table row -->
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['matric']; ?></td>  <!-- Display Matric ID -->
            <td><?php echo $row['name']; ?></td>    <!-- Display Name -->
            <td><?php echo $row['accessLevel']; ?></td> <!-- Display Access Level -->
            <td class="action-buttons">
                <!-- Link to update the user data -->
                <a href="update.php?id=<?php echo $row['id']; ?>">Update</a> |
                <!-- Form to delete a user with confirmation -->
                <form action="delete.php" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">  <!-- Hidden input for user ID -->
                    <button type="submit" class="delete">Delete</button>  <!-- Delete button -->
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
// Close the database connection after the page is loaded
$conn->close();
?>
