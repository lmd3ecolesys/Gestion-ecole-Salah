<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';

$id = $_SESSION['user']['id'];
if ($_SESSION['user']['type'] == 'admin') {
    $sql = "SELECT absence.id_absence, absence.debut, absence.fin, absence.status, absence.student
    FROM absence
    INNER JOIN student ON absence.student = student.id
    INNER JOIN user ON student.user = user.id
    ORDER BY absence.debut DESC";
} elseif ($_SESSION['user']['type'] == 'parent') {
    $sql = "SELECT absence.id_absence, absence.debut, absence.fin, absence.status, absence.student
    FROM absence
    INNER JOIN student ON absence.student = student.id
    INNER JOIN user ON student.user = user.id
    WHERE user.id = $id ORDER BY absence.debut DESC";
}


if ($con->query($sql) === False) {
    echo "Error";
} else {
    $result = $con->query($sql)

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Pedagogie - Les Absences</title>
        <link rel="stylesheet" href="../css/bootsrap.css">
        <link rel="stylesheet" href="../css/style.css">
        <!-- <script src="../js/jquery.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

       <script>
            $(document).ready(function() {
                $("#addBtn").click(function() {
                    $("#add-emplois").toggle();
                    var buttonText = $("#add-emplois").is(":visible") ? "Annuler" : "Ajouter";
                    var buttonClass = $("#add-emplois").is(":visible") ? "btn btn-danger" : "btn btn-primary";
                    $(this).text(buttonText);
                    $(this).removeClass();
                    $(this).addClass(buttonClass);
                });
                $('.edit_student').click(function() {
                    var id = $(this).attr('data-id');
                    var conf = confirm('Are you sure to edit this data.');
                    if (conf == true) {
                        url = "./edit_absence.php?id=" + id;
                        location.replace(url);
                    }
                });
                // Form validation using Bootstrap
                $('#edit_student').on('submit', function(event) {
                    if (this.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    $(this).addClass('was-validated');
                });
            })
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
            <div class="row">
                <div class="col-md-6">
                    <h2>Liste des Absences</h2>
                </div>
                <div class="col-md-6 text-right">
                    <?php
                    if ($_SESSION['user']['type'] == 'admin') {
                        echo '<button id="addBtn" class="btn btn-primary">Ajouter</button>';
                    } ?>
                </div>
            </div>
            <div id="add-emplois" class="container" style='display: none;'>
                <form action="add_absence.php" class="needs-validation" method="post" enctype="multipart/form-data" id="edit_student" novalidate>
                    <div class="form-group">
                        <label for="debut">Date de début de l'absence</label>
                        <input type="datetime-local" name="debut" id="debut" class="form-control timepicker" placeholder="sélectionez une date" required>
                        <div class="invalid-feedback">SVP, entrez la date du début !</div>
                    </div>
                    <div class="form-group">
                        <label for="fin">Date de fin de l'absence</label>
                        <input type="datetime-local" name="fin" id="fin" class="form-control timepicker" placeholder="sélectionez une date" required>
                        <div class="invalid-feedback">SVP, entrez la date du fin !</div>
                    </div>
                    <div class="form-group">
                        <label for="std">Etudiant</label>
                        <select name="std" class="form-control" id="std">
                            <?php
                            $ens = $con->query("SELECT * FROM student");
                            foreach ($ens as $en) {
                                echo '<option value="' . $en["id"] . '">' . $en["nom"] . ' ' . $en["prenom"] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">SVP, selectionnez un étudiant !</div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                        <small id="helpId" class="text-muted">Quel est son situation, par exemple: terminée</small>
                    </div>
                    <button type="submit" class="btn btn-success" name="absence">AJOUTER</button>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php
                    if ($result->num_rows > 0) {
                        echo '<table class="table table-bordered table-striped">';
                        echo '<thead><tr>';
                        echo '<th>Nom</th>';
                        echo '<th>Prénom</th>';
                        echo '<th><center>Date de Début</center></th>';
                        echo '<th><center>Date de Fin</center></th>';
                        echo '<th>Status</th>';
                        echo '<th><center>Action</center></th>';
                        echo '</tr></thead>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            $sid = $row['student'];
                            $students = $con->query("SELECT * FROM student WHERE id=$sid");
                            while ($student = $students->fetch_assoc()) {
                                echo '<td>' . $student['nom'] . '</td>';
                                echo '<td>' . $student['prenom'] . '</td>';
                            }
                            echo '<td><center>' . $row['debut'] . '</center></td>';
                            echo '<td><center>' . $row['fin'] . '</center></td>';
                            echo '<td>' . $row['status'] . '</td>';
                            echo '<td style="width: 130px;" class="d-flex justify-content-around">';
                            if ($_SESSION['user']['type'] == 'admin') {
                                echo '<button class="btn btn-sm btn-outline-primary edit_student" data-id="' . $row['id_absence'] . '" type="button"><i class="fa fa-edit"></i></button>';
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        // No data found, display a Bootstrap alert
                        echo "<div class='alert alert-warning' role='alert'>Aucune absence est trouvée</div>";
                    }
                    ?>
                </div>
            </div>
        </main>
        <!-- FOOTER -->
    

        <script src="../js/bootsrap1.js"></script>
        <script src="../js/bootsrap2.js"></script>
    </body>

    </html>
<?php
}
$con->close();
?>