<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';
$type = $_GET['type'];

switch ($type) {
    case 'cantine':
        $debut = 'Ouverture';
        $fin = 'Fermetture';
        break;
    case 'clinique':
        $debut = 'Ouverture';
        $fin = 'Fermetture';
        break;
    case 'bibliothèque':
        $debut = 'Ouverture';
        $fin = 'Fermetture';
        break;
    case 'transport':
        $debut = "Départ de l'école";
        $fin = "Arrivé à l'école";
        break;
}
if ((isset($_SESSION['user']))&&($_SESSION['user']['type']=='admin')) {
    $sql = "SELECT * FROM service WHERE type='$type'";
}else{
    $sql = "SELECT * FROM service WHERE type='$type' AND status='valide'";
}

$result = $con->query($sql);
if ($result === False) {
    echo "Error";
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/bootsrap.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/service_details.scss">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                // Form validation using Bootstrap
                $('#emploisForm').on('submit', function(event) {
                    if (this.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    $(this).addClass('was-validated');
                });
                $('.remove_emplois').click(function() {
                    var id = $(this).attr('data-id');
                    var type = "<?php echo $type; ?>";
                    console.log('type');
                    var conf = confirm('Are you sure to delete this data.');
                    if (conf == true) {
                        url = "./delete_service.php?id=" + id +"&type="+ type;
                        location.replace(url);
                    }
                });
            })
        </script>
        <!-- <link rel="stylesheet" href="../css/service_card.css"> -->
        <title>Service - <?php echo ucfirst($type) ?></title>
        <style>
            * {
                box-sizing: border-box;
                margin: 0 auto;
            }

            .card-container {
                perspective: 50em;
                margin-top: 5rem;
                margin-bottom: 5rem;
            }

            main {
                margin: 20px;
                padding: 5px;
            }
        </style>
    </head>

    <body>
        <!-- HEADER -->
        <?php include '../public/inclouds/navbar.php' ?>

        <div class="card-container">
            <div class="card">
                <h3>Service <?php echo ucfirst($type) ?></h3><br>
                <div class="layers">
                    <div class="layer"></div>
                    <div class="layer"></div>
                    <div class="layer"></div>
                    <div class="layer"></div>
                    <div class="layer"></div>
                    <div class="layer"></div>
                    <div class="layer"></div>
                    <div class="layer"></div>
                    <div class="layer"></div>
                    <div class="layer"></div>
                </div>
            </div>
        </div>

        <main>
            <div class="row">
                <h2><?php echo $debut . ' et ' . $fin . ' du ' . ucfirst($type) ?></h2>
                <div class="col-md-6 text-right">
                    <?php
                    if (isset($_SESSION['user']) && ($_SESSION['user']['type'] == 'admin')) {
                        echo '<button id="addBtn" class="btn btn-primary">Ajouter</button>';
                    }
                    // echo '<button id="addBtn" class="btn btn-primary">Ajouter</button>';
                    ?>
                </div>
            </div>
            <div id="add-emplois" class="container" style='display: none;'>
                <form action="add_service.php" class="needs-validation" method="post" enctype="multipart/form-data" id="emploisForm" novalidate>
                    <div class="form-group">
                        <label for="educativeYear">Jour</label>
                        <input type="text" class="form-control" id="educativeYear" name="jour" required>
                        <div class="invalid-feedback">Ce champs est obligatoire</div>
                    </div>
                    <div class="form-group">
                        <label for="debut"><?php echo $debut; ?></label>
                        <input type="text" class="form-control" id="debut" name="debut" required>
                        <div class="invalid-feedback">Ce champs est obligatoire</div>
                    </div>
                    <div class="form-group">
                        <label for="fin"><?php echo $fin; ?></label>
                        <input type="text" class="form-control" id="fin" name="fin" required>
                        <div class="invalid-feedback">Ce champs est obligatoire</div>
                    </div>
                    <div class="form-group">
                        <label for="type">Service</label>
                        <input type="text" class="form-control" id="type" name="type" value="<?php echo $type; ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Envoyer</button>
                </form>
            </div>
            <!-- <div class="card"> -->
            <div class="card-body">
                <?php
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    echo '<table class="table table-bordered table-striped">';
                    echo '<thead><tr>';
                    echo '<th>Jour</th>';
                    echo '<th><center>' . $debut . '</center></th>';
                    echo '<th><center>' . $fin . '</center></th>';
                    echo '<th><center>Action</center></th>';
                    echo '</tr></thead>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['jour'] . '</td>';
                        echo '<td><center>' . $row['debut'] . '</center></td>';
                        echo '<td><center>' . $row['fin'] . '</center></td>';
                        echo '<td>';
                        if ((isset($_SESSION['user']))&&($_SESSION['user']['type']=='admin')) {
                        echo '<center><button class="btn btn-sm btn-outline-danger remove_emplois" data-id="' . $row['id'] . '" type="button"><i class="fa fa-trash"></i></button></center>';
                        }
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    // No data found, display a Bootstrap alert
                    echo "<div class='alert alert-warning' role='alert'>Aucune horaire est ajouté</div>";
                }
                ?>
            </div>
            <!-- </div> -->
        </main>

        <!-- FOOTER -->
     

        <script src="../js/bootsrap1.js"></script>
        <script src="../js/bootsrap2.js"></script>
    </body>

    </html>
<?php
    $con->close();
}
?>


