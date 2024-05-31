<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';
$admin = $_SESSION['user']['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_POST['submit'])) {
        if (isset($_FILES["file"])) {
            if ($_FILES["file"]["error"] == 0) {
                $level = $_POST['level'];
                $group = $_POST['group'];
                $trimestre = $_POST['trimestre'];
                $annee = $_POST['year'];
                // echo $level;
                // echo $group;
                // echo $trimestre;
                // echo $annee;
                $target_dir = "../uploads/emplois/"; // Change this to the desired directory for uploaded files
                $target_file = $target_dir . basename($_FILES["file"]["name"]);
                $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Move the uploaded file to the specified directory
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    // File upload success, now store information in the database
                    $filename = $_FILES["file"]["name"];

                    // Insert the file information into the database
                    $sql = "INSERT INTO emplois (niveau, filename, trimestre, groupe, annee, admin) VALUES ('$level', '$filename', '$trimestre', '$group', '$annee', '$admin')";

                    if ($con->query($sql) === TRUE) {
                        header('Location: emplois.php');
                    } else {
                        echo "<script>alert('Sorry, there was an error uploading your file and storing information in the database: " . $con->error . "')</script>";
                    }

                    $con->close();
                } else {
                    echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
                }
            }else {
                echo "<script>alert('file error is not 0')</script>";
            }
        } else {
            echo "<script>alert('No file was uploaded!!!!')</script>";
        }
    } else {
        echo "<script>alert('Form not sent!!!!')</script>";
    }
}
