<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';
$admin = $_SESSION['user']['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $jour = ucfirst($_POST['jour']);
        $debut = $_POST['debut'];
        $fin = $_POST['fin'];
        $type = $_POST['type'];

        $req = "INSERT INTO service (jour, debut, fin, type, admin) VALUES ('$jour','$debut','$fin', '$type', '$admin')";
        if ($con->query($req) === TRUE) {
            header('Location: service_detail.php?type='.$type.'');
        } else {
            echo "<script>alert('Sorry: " . $con->error . "')</script>";
        }

        $con->close();
    }
}
