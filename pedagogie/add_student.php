<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';
$admin = $_SESSION['user']['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_POST['submit'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $naissance = $_POST['naissance'];
        $niveau = $_POST['niveau'];
        $groupe = $_POST['groupe'];
        $id_parent = $_POST['parent'];
        // $status = $_POST['status'];
        $insert = "INSERT INTO student (nom, prenom, naissance, niveau, groupe, user, admin) VALUES ('$nom', '$prenom', '$naissance', '$niveau', '$groupe', $id_parent, '$admin')";

        // Insert the file information into the database
        if ($con->query($insert) === TRUE) {
            header('Location: student_list.php');
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file and storing information in the database: " . $con->error . "')</script>";
        }

        $con->close();
    } else {
        echo "<script>alert('Form not sent!!!!')</script>";
    }
}
