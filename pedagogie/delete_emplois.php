<?php
include_once '../database/dbcon.php';

$id = $_GET["id"];
$sql = "UPDATE emplois SET status='invalide' WHERE id = '$id'";
if ($con->query($sql) === TRUE) {
    header('Location: emplois.php');
} else {
    echo "<script>alert('Sorry: " . $con->error . "')</script>";
}

$con->close();
