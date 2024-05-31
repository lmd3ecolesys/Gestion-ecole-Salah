<?php
include_once '../database/dbcon.php';

$id = $_GET["id"];
$type = $_GET['type'];
$sql = "UPDATE service SET status='invalide' WHERE id = '$id'";
if ($con->query($sql) === TRUE) {
    header('Location: service_detail.php?id='.$id.'&type='.$type.'');
} else {
    echo "<script>alert('Sorry: " . $con->error . "')</script>";
}

$con->close();
