<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';
$id = $_GET['id'];
$students = $con->query("SELECT * FROM student WHERE id = $id");

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $naissance = $_POST['naissance'];
    $niveau = $_POST['niveau'];
    $groupe = $_POST['groupe'];
    $id_parent = $_POST['parent'];
    $status = $_POST['status'];
    $now = date_create()->format('Y-m-d H:i:s');
    // Insert the file information into the database
    $sql = "UPDATE student SET date='$now', nom='$nom', prenom='$prenom', naissance='$naissance', niveau='$niveau', groupe='$groupe', user='$id_parent', status='$status' WHERE id='$id'";
    if ($con->query($sql) === TRUE) {
        header('Location: student_list.php');
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file and storing information in the database: " . $con->error . "')</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>Pedagogy - Elèves</title>
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
        <h2>Modifer La Liste Des Elèves</h2>
        <?php
        foreach ($students as $student) {
            $parent_id = $student['user'];
            $parents = $con->query('SELECT * FROM user WHERE type ="parent"');
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
                    <div class='form-group' id='picker'>
                        <label for="naissance">Date de naissance</label>
                        <input type='date' id='naissance' name="naissance" class="form-control" value="<?php echo $student['naissance'] ?>" required />
                        <div class="invalid-feedback">SVP, Entrez la date de naissance !</div>
                    </div>
                    <div class="form-group">
                        <label for="educationLevel">Niveau d'étude</label>
                        <select name="niveau" class="form-control" id="educationLevel">
                            <option value="1ere Année">1ere Année</option>
                            <option value="2eme Année">2eme Année</option>
                            <option value="3eme Année">3eme Année</option>
                            <option value="4eme Année">4eme Année</option>
                        </select>
                        <div class="invalid-feedback">SVP, selectionnez un niveau !</div>
                    </div>
                    <div class="form-group">
                        <label for="group">Groupe</label>
                        <select class="form-control" id="group" name="groupe">
                            <!-- Options will be dynamically populated based on the selected education level -->
                            <option value="1AM1">1AM1</option>
                            <option value="1AM2">1AM2</option>
                            <option value="1AM3">1AM3</option>
                            <option value="1AM4">1AM4</option>
                            <option value="2AM1">2AM1</option>
                            <option value="2AM2">2AM2</option>
                            <option value="2AM3">2AM3</option>
                            <option value="2AM4">2AM4</option>
                            <option value="3AM1">3AM1</option>
                            <option value="3AM2">3AM2</option>
                            <option value="3AM3">3AM3</option>
                            <option value="3AM4">3AM4</option>
                            <option value="4AM1">4AM1</option>
                            <option value="4AM2">4AM2</option>
                            <option value="4AM3">4AM3</option>
                            <option value="4AM4">4AM4</option>
                        </select>
                        <div class="invalid-feedback">SVP, selectionnez un groupe !</div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status d'étudiant</label>
                        <select class="form-control" id="status" name="status">
                            <option value="étudié">Etudié</option>
                            <option value="non étudié"> Non étudié</option>
                        </select>
                        </div>
                    <div class="form-group">
                        <label for="parent"></label>
                        <select name="parent" id="parent" class="form-control">
                            <?php
                            if ($parents->num_rows > 0) {
                                while ($parent = $parents->fetch_assoc()) {
                                    // Check if the option's id matches $parent_id, if so, mark it as selected
                                    $selected = ($parent["id"] == $parent_id) ? 'selected="selected"' : '';
                                    // Output the option tag
                                    echo '<option value="' . $parent["id"] . '" ' . $selected . '>' . $parent["nom"] . ' ' . $parent['prenom'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <small id="helpId" class="text-muted">Il faut confirmer sue le parent est ajouter dans la liste des parent</small>
                        <div class="invalid-feedback">SVP, selectionnez un parent !</div>
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