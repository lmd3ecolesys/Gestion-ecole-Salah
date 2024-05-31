<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';
$admin = $_SESSION['user']['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_POST['absence'])) {
        // Set parameters
        $date = $_POST['date'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $std = $_POST['std'];

        // Prepare and bind the SQL statement
        $stmt = $con->prepare("INSERT INTO observation (date, description, status, student, admin) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $date, $description, $status, $std, $admin);

        // Execute the statement
        if ($stmt->execute()) {
            header('Location: observation.php');
            exit();
        } else {
            echo "<script>alert('Sorry, there was an error storing information in the database.')</script>";
        }

        // Close the statement
        $stmt->close();
    }
} else {
    echo "<script>alert('Form not sent!!!!')</script>";
}

$con->close();
