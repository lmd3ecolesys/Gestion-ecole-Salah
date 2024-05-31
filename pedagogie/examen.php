<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';
$level = $_GET['level'];
$trimestre = $_GET['trimestre'];
if ((isset($_SESSION['user']))&&($_SESSION['user']['type']=='admin')) {
        $sql = "SELECT * FROM examen WHERE niveau='$level' AND trimestre='$trimestre' ORDER BY added_at DESC";
}else {
    $sql = "SELECT * FROM examen WHERE niveau='$level' AND trimestre='$trimestre' AND status='valide' ORDER BY added_at DESC";
}
if ($con->query($sql) === False) {
    echo "Error";
} else {

?>

    <!DOCTYPE html>
    <html>

    <head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <title>Pedagogy - Planning des examens</title>
        <link rel="stylesheet" href="../css/bootsrap.css">
        <link rel="stylesheet" href="../css/style.css">
        <!-- <script src="../js/jquery.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
        <script>
            $(document).ready(function() {
                $('.remove_emplois').click(function() {
                    var id = $(this).attr('data-id');
                    var conf = confirm('Are you sure to delete this data.');
                    if (conf == true) {
                        url = "./delete_examen.php?id=" + id;
                        location.replace(url);
                    }
                })
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
            <h2>Planning des Examens</h2>
            <div class="card">
                <div class="card-body">
                <?php
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    echo '<table class="table table-bordered table-striped">';
                    echo '<thead><tr>';
                    echo '<th>Nom du Fichier</th>';
                    echo '<th><center>Année Scolaire</center></th>';
                    echo '<th><center>Action</center></th>';
                    echo '</tr></thead>';
                    while ($row = $result->fetch_assoc()) {
                        // print($row['id']);
                        $file_path = '../uploads/examens/' . $row["filename"];
                        echo '<tr>';
                        echo '<td>' . $row['filename'] . '</td>';
                        echo '<td><center>' . $row['annee'] . '</center></td>';
                        echo '<td style="width=130px;" class="d-flex justify-content-around">';
                        echo '<a href="' . $file_path . '" download><button class="btn btn-sm btn-outline-primary download_file" data-id="' . $row['id_examen'] . '" type="button"><i class="fa fa-download"></i></button></a>';
                        // echo '&nbsp&nbsp&nbsp&nbsp';
                        if (($_SESSION['user']['type'] == 'admin') && ($row['status'] == 'active')) {
                            echo '<button class="btn btn-sm btn-outline-danger remove_emplois" data-id="' . $row['id_examen'] . '" type="button"><i class="fa fa-trash"></i></button>';
                        }

                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    // No data found, display a Bootstrap alert
                    echo "<div class='alert alert-warning' role='alert'>un fichier est partagé</div>";
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