<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';

$id = $_SESSION['user']['id'];

if ($_SESSION['user']['type'] == 'admin') {
    $sql = "SELECT observation.id, observation.description, observation.date, observation.status, observation.student
    FROM observation
    INNER JOIN student ON observation.student = student.id
    INNER JOIN user ON student.user = user.id
    ORDER BY date DESC";
} elseif ($_SESSION['user']['type'] == 'parent') {
    $sql = "SELECT observation.id, observation.description, observation.date, observation.status, observation.student
    FROM observation
    INNER JOIN student ON observation.student = student.id
    INNER JOIN user ON student.user = user.id
    WHERE user.id = $id ORDER BY date DESC";
}

if ($con->query($sql) === False) {
    echo "Error";
} else {

?>

    <!DOCTYPE html>
    <html>

    <head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <title>Pedagogie - Les Observations</title>
        <link rel="stylesheet" href="../css/bootsrap.css">
        <link rel="stylesheet" href="../css/style.css">
        <!-- <script src="../js/jquery.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
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
                        url = "./edit_observation.php?id=" + id;
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
                    <h2>Liste des Observations</h2>
                </div>
                <div class="col-md-6 text-right">
                    <?php
                    if ($_SESSION['user']['type'] == 'admin') {
                        echo '<button id="addBtn" class="btn btn-primary">Ajouter</button>';
                    } ?>
                </div>
            </div>
            <div id="add-emplois" class="container" style='display: none;'>
                <form action="add_observation.php" class="needs-validation" method="post" enctype="multipart/form-data" id="edit_student" novalidate>
                    <div class="form-group">
                        <label for="debut">Date Mettre</label>
                        <input type="datetime-local" name="date" id="debut" class="form-control timepicker" placeholder="sélectionez une date" required>
                        <div class="invalid-feedback">SVP, entrez la date du début !</div>
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
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                        <small id="helpId" class="text-muted">donne tous détails de cette observation</small>
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
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    echo '<table class="table table-bordered table-striped">';
                    echo '<thead><tr>';
                    echo '<th>Nom</th>';
                    echo '<th>Prénom</th>';
                    echo '<th><center>Date de Mettre</center></th>';
                    echo '<th><center>Description</center></th>';
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
                        echo '<td><center>' . $row['date'] . '</center></td>';
                        echo '<td>' . $row['description'] . '</td>';
                        echo '<td>' . $row['status'] . '</td>';
                        echo '<td style="width=130px;" class="d-flex justify-content-around">';
                        if ($_SESSION['user']['type'] == 'admin') {
                            echo '<button class="btn btn-sm btn-outline-primary edit_student" data-id="' . $row['id'] . '" type="button"><i class="fa fa-edit"></i></button></>';
                        }
                        // echo '<button class="btn btn-sm btn-outline-danger remove_student" data-id="' . $row['id'] . '" type="button"><i class="fa fa-trash"></i></button></>';
                        // echo '&nbsp&nbsp&nbsp&nbsp';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    // No data found, display a Bootstrap alert
                    echo "<div class='alert alert-warning' role='alert'>Aucune observation est trouvée</div>";
                }
            }
            $con->close();
                ?>
                </div>
            </div>
        </main>
        <!-- FOOTER -->
     

        <script src="../js/bootsrap1.js"></script>
        <script src="../js/bootsrap2.js"></script>
    </body>

    </html>