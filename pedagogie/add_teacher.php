<?php
include_once '../database/dbcon.php';
function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $nom = mysqli_real_escape_string($con, $_POST['nom']);
    $prenom = mysqli_real_escape_string($con, $_POST['prenom']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $tel = $_POST['tel'];
    $type = mysqli_real_escape_string($con, $_POST['type']);

    // Hash the password
    // $hashedPassword = hashPassword($password);
    $ens = $con->query("SELECT * FROM user WHERE username='$username' AND type='$type'");
    if ($ens->num_rows > 0) {
        echo "<script>alert('Username existe déjà')</script>";
    } else {
        $insert = "INSERT INTO user (nom, prenom, username, email, password, status, tel, type) VALUES ('$nom', '$prenom', '$username', '$email', '$password', '$status', '$tel', '$type')";
        // $sql = "UPDATE enseignant SET nom='$nom', prenom='$prenom', username='$username', email='$email', password='$password', status='$status', tel='$tel' WHERE id='$id'";
        if ($con->query($insert) === TRUE) {
            header('Location: teachers_list.php');
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file and storing information in the database: " . $con->error . "')</script>";
        }
    }
}

$con->close();
