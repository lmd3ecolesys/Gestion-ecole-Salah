<?php
include_once '../database/dbcon.php';

$id = $_GET["id"];
$sql = "UPDATE devoir SET status='invalide' WHERE id_devoir = '$id'";
if ($con->query($sql) === TRUE) {
    header('Location: planning.php');
} else {
    echo "<script>alert('Sorry: " . $con->error . "')</script>";
}

$con->close();
