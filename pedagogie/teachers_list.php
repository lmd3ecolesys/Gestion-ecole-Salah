<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';

$sql = "SELECT * FROM user ORDER BY username DESC";
if ($con->query($sql) === False) {
    echo "Error";
} else {

?>

    <!DOCTYPE html>
    <html>

    <head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <title>Pedagogie - Les Utilisateur</title>
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
                        url = "./edit_teacher.php?id=" + id;
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
                    <h2>Liste des Utilisateurs</h2>
                </div>
                <div class="col-md-6 text-right">
                    <?php
                    if (isset($_SESSION['user'])&&($_SESSION['user']['type'] == 'admin')) {
                        echo '<button id="addBtn" class="btn btn-primary">Ajouter</button>';
                    }
                    ?>
                </div>
            </div>
            <div id="add-emplois" class="container" style='display: none;'>
                <form action="add_teacher.php" class="needs-validation" method="post" enctype="multipart/form-data" id="edit_student" novalidate>
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
                    <div class="form-group">
                        <label for="username">Userame</label>
                        <input type="text" name="username" class="form-control" id="username" required>
                        <div class="invalid-feedback">SVP, Entrez un username !</div>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                        <div class="invalid-feedback">SVP, Entrez un email !</div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <div class="invalid-feedback">SVP, Entrez le password !</div>
                    </div>
                    <div class="form-group">
                        <label for="tel">Numéro de Téléphone</label>
                        <input type="tel" name="tel" class="form-control" id="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                        <small id="helpId" class="text-muted">le numéro de téléphone doit-être au format xxx-xxx-xxxx</small>
                        <div class="invalid-feedback">SVP, Entrez le nuéro de téléphone !</div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                        <small id="helpId" class="text-muted">Quel est son situation, par exemple: il est notre enseignant</small>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="admin">Admin</option>
                            <option value="parent">Parent</option>
                            <option value="enseignant">Enseignant</option>
                        </select>
                        <small id="helpId" class="text-muted">Quel est son situation, par exemple: il est notre enseignant</small>
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
                    echo '<th>Username</th>';
                    echo '<th>Email</th>';
                    echo '<th>Numéro de Téléphone</th>';
                    echo '<th>Status</th>';
                    echo '<th>Type</th>';
                    echo '<th><center>Action</center></th>';
                    echo '</tr></thead>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['nom'] . '</td>';
                        echo '<td>' . $row['prenom'] . '</td>';
                        echo '<td>' . $row['username'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['tel'] . '</td>';
                        echo '<td>' . $row['status'] . '</td>';
                        echo '<td>' . $row['type'] . '</td>';
                        echo '<td style="width=130px;" class="d-flex justify-content-around">';
                        if(isset($_SESSION['user'])&&($_SESSION['user']['type'] == 'admin')){
                            echo '<button class="btn btn-sm btn-outline-primary edit_student" data-id="' . $row['id'] . '" type="button"><i class="fa fa-edit"></i></button></>';
                        }
                        // echo '&nbsp&nbsp&nbsp&nbsp';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    // No data found, display a Bootstrap alert
                    echo "<div class='alert alert-warning' role='alert'>Aucun utilisateurs est trouvé</div>";
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