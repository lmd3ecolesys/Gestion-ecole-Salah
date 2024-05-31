<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';

$id = $_GET['id'];
// echo $id;
$students = $con->query("SELECT * FROM observation WHERE id = $id");

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $std = $_POST['std'];

    // Prepare the SQL statement
    $stmt = $con->prepare("UPDATE observation SET date=?, description=?, status=?, student=? WHERE id=?");

    // Bind parameters
    $stmt->bind_param("ssssi", $date, $description, $status, $std, $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the observation page after successful update
        header('Location: observation.php');
        exit();
    } else {
        // Handle error if the update fails
        echo "<script>alert('Sorry, there was an error updating the observation.')</script>";
    }

    // Close the statement
    $stmt->close();
    // // Insert the file information into the database
    // $sql = "UPDATE observation SET date='$date', description='$description', status='$status', student='$std' WHERE id='$id'";
    // if ($con->query($sql) === TRUE) {
    //     header('Location: observation.php');
    // } else {
    //     echo "<script>alert('Sorry, there was an error uploading your file and storing information in the database: " . $con->error . "')</script>";
    // }
}
?>
<!DOCTYPE html>
<html>

<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>Pedagogy - Observation</title>
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
        <h2>Modifer La Liste Des Absence</h2>
        <?php
        foreach ($students as $student) {
            $stdid = $student['student'];
            // print($parents->num_rows)
        ?>
            <div id="add-emplois" class="container" style='display: block;'>
                <form class="needs-validation" method="post" enctype="multipart/form-data" id="edit_student" novalidate>
                    <div class="form-group">
                        <label for="debut">Date de Mettre</label>
                        <input value="<?php echo $student['date']; ?>" type="datetime-local" name="date" id="debut" class="form-control timepicker" placeholder="sélectionez une date" required>
                        <div class="invalid-feedback">SVP, entrez la date du début !</div>
                    </div>
                    <div class="form-group">
                        <label for="std">Etudiant</label>
                        <select name="std" class="form-control" id="std">
                            <?php
                            $ens = $con->query("SELECT * FROM student");
                            foreach ($ens as $en) {
                                $selected = ($en["id"] == $stdid) ? 'selected="selected"' : '';
                                echo '<option value="' . $en["id"] . '"' . $selected . '>' . $en["nom"] . ' ' . $en["prenom"] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">SVP, selectionnez un étudiant !</div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input value="<?php echo $student['description']; ?>" type="text" class="form-control" id="description" name="description" required>
                        <small id="helpId" class="text-muted">donner tous les détails du cette observation</small>
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
    < <?php include '../public/inclouds/footer.php' ?>

    <script src="../js/bootsrap1.js"></script>
    <script src="../js/bootsrap2.js"></script>
</body>

</html>