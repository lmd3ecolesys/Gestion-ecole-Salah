<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';
$admin = $_SESSION['user']['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['devoir'])) {
        $annee = $_POST['year'];
        $matiere = $_POST['matiere'];
        $trimestre = $_POST['trimestre'];
        $niveau = $_POST['level'];
        $groupe = $_POST['group'];
        $id_ens = $_POST['ens'];
        $date = $_POST['date'];
        // Convert datetime string to a Unix timestamp
        $timestamp = strtotime($date);

        // Format the Unix timestamp to retrieve only the date (Y-m-d)
        $date_new = date("Y-m-d", $timestamp);

        $dates = $con->query("SELECT * FROM devoir WHERE DATE(date) = '$date_new' AND niveau = '$niveau' AND groupe = '$groupe' AND annee='$annee' AND status='valide'");
        if ($dates->num_rows > 1) {
            echo "<script>alert('un groupe ne peut passer que 2 devoirs par jour')</script>";
        } else {
            $insert = "INSERT INTO devoir (annee, matiere, trimestre, niveau, groupe, ens, date, admin) VALUES ('$annee', '$matiere', '$trimestre', '$niveau', '$groupe', '$id_ens', '$date', '$admin')";

            // Insert the file information into the database
            if ($con->query($insert) === TRUE) {
                header('Location: planning.php');
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file and storing information in the database: " . $con->error . "')</script>";
            }
        }

        $con->close();
    } else {
        echo "<script>alert('Form not sent!!!!')</script>";
    }
}
