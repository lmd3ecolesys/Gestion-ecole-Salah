<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';

// Function to hash passwords
function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}
$id = $_GET['id'];
$students = $con->query("SELECT * FROM user WHERE id = $id");

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
    $ens = $con->query("SELECT * FROM user WHERE username='$username' AND id!='$id'");
    if ($ens->num_rows > 0) {
        echo "<script>alert('Username existent déja')</script>";
    } else {
        $sql = "UPDATE user SET nom='$nom', prenom='$prenom', username='$username', email='$email', password='$password', status='$status', tel='$tel', type='$type' WHERE id='$id'";
        if ($con->query($sql) === TRUE) {
            header('Location: teachers_list.php');
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file and storing information in the database: " . $con->error . "')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>Pedagogy - Utilisateur</title>
    <link rel="stylesheet" href="../css/bootsrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#edit_student').on('submit', function(event) {
                if (this.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                $(this).addClass('was-validated');
            });
        });
    </script>
    <style>
        main {
            margin: 20px;
            padding: 5px;
        }

        .card {
            margin: 20px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <?php include '../public/inclouds/navbar.php' ?>
    <main>
        <h2>Modifer La Liste Des Utilisateurs</h2>
        <?php
        foreach ($students as $student) {
            // print($parents->num_rows)
        ?>
            <div id="add-emplois" class="container" style='display: block;'>
                <form class="needs-validation" method="post" enctype="multipart/form-data" id="edit_student" novalidate>
                    <div class="form-group">
                        <label for="nom">Nom de Famille</label>
                        <input type="text" name="nom" class="form-control" id="nom" value="<?php echo $student['nom'] ?>" required>
                        <div class="invalid-feedback">SVP, Entrez le nom du famille !</div>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" class="form-control" id="prenom" value="<?php echo $student['prenom'] ?>" required>
                        <div class="invalid-feedback">SVP, Entrez le prénom !</div>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="<?php echo $student['username'] ?>" required>
                        <div class="invalid-feedback">SVP, Entrez le username !</div>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?php echo $student['email'] ?>" required>
                        <div class="invalid-feedback">SVP, Entrez le username !</div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" value="<?php echo $student['password'] ?>" required>
                        <div class="invalid-feedback">SVP, Entrez le password !</div>
                    </div>
                    <div class="form-group">
                        <label for="tel">Numéro de Téléphone</label>
                        <input type="tel" name="tel" class="form-control" id="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $student['tel'] ?>" required>
                        <small id="helpId" class="text-muted">le numéro de téléphone doit être du format xxx-xxx-xxxx</small>
                        <div class="invalid-feedback">SVP, Entrez le numéro de telephone !</div>
                    </div>
                    <div class="form-group">
                        <label for="type">Rôle</label>
                        <select class="form-control" id="type" name="type">
                            <option value="admin">Admin</option>
                            <option value="enseignant">Enseignant</option>
                            <option value="parent">Parent</option>
                        <select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="<?php echo $student['status'] ?>" required>
                        <small id="helpId" class="text-muted">Quel est son situation, par exemple: il est notre enseignant</small>
                        <div class="invalid-feedback">SVP, Entrez le status !</div>
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">MODIFIER</button>
                </form>
            </div>
        <?php
        }
        ?>
    </main>
    <!-- FOOTER -->
   

    <script src="../js/bootsrap1.js"></script>
    <script src="../js/bootsrap2.js"></script>
</body>

</html>