<?php
include '../function/session.php';
include_once '../database/dbcon.php';

$sql = "SELECT * FROM student ORDER BY nom DESC";
if ($con->query($sql) === False) {
    echo "Error";
} else {

?>

    <!DOCTYPE html>
    <html>

    <head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <title>Pedagogie - Les Elèves</title>
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
                $('.remove_student').click(function() {
                    var id = $(this).attr('data-id');
                    var conf = confirm('Are you sure to delete this data.');
                    if (conf == true) {
                        url = "./delete_student.php?id=" + id;
                        location.replace(url);
                    }
                });
                $('.edit_student').click(function() {
                    var id = $(this).attr('data-id');
                    var conf = confirm('Are you sure to edit this data.');
                    if (conf == true) {
                        url = "./edit_student.php?id=" + id;
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
                    <h2>Liste des Elèves</h2>
                </div>
                <div class="col-md-6 text-right">
                    <?php
                        if (isset($_SESSION['user'])&&($_SESSION['user']['type'] == 'admin')){
                            echo '<button id="addBtn" class="btn btn-primary">Ajouter</button>';
                        }
                    ?>

                </div>
            </div>
            <div id="add-emplois" class="container" style='display: none;'>
                <form action="add_student.php" class="needs-validation" method="post" enctype="multipart/form-data" id="edit_student" novalidate>
                    <div class="form-group">
                        <label for="nom">Nom de Famille</label>
                        <input type="text" name="nom" class="form-control" id="nom" required>
                        <div class="invalid-feedback">SVP, Entrez le nom du famille !</div>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" class="form-control" id="prenom" required>
                        <div class="invalid-feedback">SVP, Entrez le prénom !</div>
                    </div>
                    <div class='form-group' id='picker'>
                        <label for="naissance">Date de naissance</label>
                        <input type='date' id='naissance' name="naissance" class="form-control" required />
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
                    <!-- <div class="form-group">
                        <label for="status">Status d'étudiant</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                        <small id="helpId" class="text-muted">Quel est son situation, par exemple: finit ses études dans 2022</small>
                    </div> -->
                    <div class="form-group">
                        <label for="parent"></label>
                        <select name="parent" id="parent" class="form-control">
                            <?php
                            $parents = $con->query("SELECT * FROM user WHERE type='parent'");
                            if ($parents->num_rows > 0) {
                                while ($parent = $parents->fetch_assoc()) {
                                    // Output the option tag
                                    echo '<option value="' . $parent["id"] . '">' . $parent["nom"] . ' ' . $parent['prenom'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <small id="helpId" class="text-muted">Il faut confirmer sue le parent est ajouter dans la liste des parent</small>
                        <div class="invalid-feedback">SVP, selectionnez un parent !</div>
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">AJOUTER</button>
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
                    echo '<th><center>Date de Naissance</center></th>';
                    echo '<th>Nom du Parent</th>';
                    echo '<th>Prénom du Parent</th>';
                    echo '<th>Niveau</th>';
                    echo '<th>Groupe</th>';
                    echo '<th>Status</th>';
                    echo '<th><center>Action</center></th>';
                    echo '</tr></thead>';
                    while ($row = $result->fetch_assoc()) {
                        $parent_id = $row['user'];
                        echo '<tr>';
                        echo '<td>' . $row['nom'] . '</td>';
                        echo '<td>' . $row['prenom'] . '</td>';
                        echo '<td><center>' . $row['naissance'] . '</center></td>';
                        // Informations Du Parents
                        $parents = $con->query("SELECT * FROM user WHERE id = '$parent_id'");
                        if ($parents->num_rows > 0) {
                            while ($parent = $parents->fetch_assoc()) {
                                echo '<td>' . $parent['nom'] . '</td>';
                                echo '<td>' . $parent['prenom'] . '</td>';
                            }
                        }
                        echo '<td>' . $row['niveau'] . '</td>';
                        echo '<td>' . $row['groupe'] . '</td>';
                        echo '<td>' . $row['status'] . '</td>';
                        echo '<td style="width=130px;" class="d-flex justify-content-around">';
                        if (isset($_SESSION['user'])&&($_SESSION['user']['type'] == 'admin')){
                            echo '<button class="btn btn-sm btn-outline-primary edit_student" data-id="' . $row['id'] . '" type="button"><i class="fa fa-edit"></i></button></>';
                            if ($row['status']=='étudié'){
                                echo '<button class="btn btn-sm btn-outline-danger remove_student" data-id="' . $row['id'] . '" type="button"><i class="fa fa-trash"></i></button>';
                                }
                        }
                        // echo '&nbsp&nbsp&nbsp&nbsp';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    // No data found, display a Bootstrap alert
                    echo "<div class='alert alert-warning' role='alert'>Aucun élève est trouvé</div>";
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