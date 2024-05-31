<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';
$admin = $_SESSION['user']['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_POST['absence'])) {
        $debut = $_POST['debut'];
        $fin = $_POST['fin'];
        $std = $_POST['std'];
        $status = $_POST['status'];
        $insert = "INSERT INTO absence (debut, fin, status, student, admin) VALUES ('$debut', '$fin', '$status', '$std', '$admin')";

        // Insert the file information into the database
        if ($con->query($insert) === TRUE) {
            header('Location: absence.php');
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file and storing information in the database: " . $con->error . "')</script>";
        }
    }

    $con->close();
} else {
    echo "<script>alert('Form not sent!!!!')</script>";
}
