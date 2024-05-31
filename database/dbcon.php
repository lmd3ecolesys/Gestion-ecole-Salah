<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'madrassati';
    $port = 8306;
    $con = mysqli_connect($host, $user, $password, $database);
    if (!$con){
        ?>
            <script>alert("Connection Unsuccessful!!!");</script>
        <?php
    }
?>

