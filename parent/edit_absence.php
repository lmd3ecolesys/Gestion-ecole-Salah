<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';

$id = $_GET['id'];
$students = $con->query("SELECT * FROM absence WHERE id = $id");

if (isset($_POST['submit'])) {
    $debut = $_POST['debut'];
    $fin = $_POST['fin'];
    $status = $_POST['status'];
    $std = $_POST['std'];
    // Insert the file information into the database
    $sql = "UPDATE absence SET debut='$debut', fin='$fin', status='$status', student='$std' WHERE id='$id'";
    if ($con->query($sql) === TRUE) {
        header('Location: absence.php');
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file and storing information in the database: " . $con->error . "')</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>Pedagogy - Absence</title>
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
        <h2>Modifer La Liste Des Absences</h2>
        <?php
        foreach ($students as $student) {
            $stdid = $student['student'];
            // print($parents->num_rows)
        ?>
            <div id="add-emplois" class="container" style='display: block;'>
                <form class="needs-validation" method="post" enctype="multipart/form-data" id="edit_student" novalidate>
                    <div class="form-group">
                        <label for="debut">Date de début de l'absence</label>
                        <input value="<?php echo $student['debut']; ?>" type="datetime-local" name="debut" id="debut" class="form-control timepicker" placeholder="sélectionez une date" required>
                        <div class="invalid-feedback">SVP, entrez la date du début !</div>
                    </div>
                    <div class="form-group">
                        <label for="fin">Date de fin de l'absence</label>
                        <input value="<?php echo $student['fin']; ?>" type="datetime-local" name="fin" id="fin" class="form-control timepicker" name="date" placeholder="sélectionez une date" required>
                        <div class="invalid-feedback">SVP, entrez la date du fin !</div>
                    </div>
                    <div class="form-group">
                        <label for="std">Etudiant</label>
                        <select name="std" class="form-control" id="std">
                            <?php
                            $ens = $con->query("SELECT * FROM student");
                            foreach ($ens as $en) {
                                $selected = ($en["id"] == $stdid) ? 'selected="selected"' : '';
                                echo '<option value="' . $en["id"] . '"'.$selected.'>' . $en["nom"] . ' ' . $en["prenom"] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">SVP, selectionnez un étudiant !</div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input value="<?php echo $student['status']; ?>" type="text" class="form-control" id="status" name="status" required>
                        <small id="helpId" class="text-muted">Quel est son situation, par exemple: non justifée</small>
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">MODIFIER</button>
                </form>
            </div>
        <?php
        }
        ?>
    </main>
    <!-- FOOTER -->
    <?php include '../public/inclouds/footer.php' ?>

    <script src="../js/bootsrap1.js"></script>
    <script src="../js/bootsrap2.js"></script>
</body>

</html>