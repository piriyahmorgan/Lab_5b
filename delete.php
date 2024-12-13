<?php
// Start the session to manage user authentication
session_start();

// Ensure the user is logged in, if not redirect to the login page
if (!isset($_SESSION['logged_in'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Connect to the database
$conn = new mysqli("localhost", "root", "Piriyah@110599", "Lab_5b");

// Check for a successful database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request when the form to delete a user is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id']; // Get the ID of the user to be deleted

    // Prepare the SQL DELETE query
    $deleteQuery = "DELETE FROM users WHERE id = '$id'";

    // Execute the delete query
    if ($conn->query($deleteQuery)) {
        // Redirect to the display page after successful deletion
        header("Location: display.php");
        exit(); // Ensure no further code is executed after the redirect
    } else {
        // If there is an error with the deletion, display the error message
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Handle invalid requests where 'id' is not set
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
