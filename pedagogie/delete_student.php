<?php
include_once '../database/dbcon.php';


$id = $_GET["id"];
$sql = "UPDATE student SET status='non étudié' WHERE id = '$id'";
if ($con->query($sql) === TRUE) {
    header('Location: student_list.php');
} else {
    echo "<script>alert('Sorry: " . $con->error . "')</script>";
}

$con->close();