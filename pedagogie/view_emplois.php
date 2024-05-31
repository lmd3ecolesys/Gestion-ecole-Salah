<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';
$level = $_GET['level'];
$group = $_GET['groupe'];
$trimestre = $_GET['trimestre'];
if ((isset($_SESSION['user']))&&($_SESSION['user']['type']=='admin')){
    $sql = "SELECT * FROM emplois WHERE niveau='$level' AND groupe='$group' AND trimestre='$trimestre' ORDER BY added_at DESC";
}else {
    $sql = "SELECT * FROM emplois WHERE status='valide' AND niveau='$level' AND groupe='$group' AND trimestre='$trimestre' ORDER BY added_at DESC";
}
if ($con->query($sql) === False) {
    echo "Error";
} else {

?>
    <!DOCTYPE html>
    <html>

    <head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <title>Pedagogy - Levels and Groups</title>
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
                        url = "./delete_emplois.php?id=" + id;
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
            <h2>Emplois Du Temps</h2>
            <div class="card">
                <div class="card-body">
                <?php
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    echo '<table class="table table-bordered table-striped">';
                    echo '<thead><tr>';
                    echo '<th>Nom du Fichier</th>';
                    echo '<th><center>Année Scolaire</center></th>';
                    echo '<th>Status</th>';
                    echo '<th><center>Action</center></th>';
                    echo '</tr></thead>';
                    while ($row = $result->fetch_assoc()) {
                        $file_path = '../uploads/emplois/' . $row["filename"];
                        echo '<tr>';
                        echo '<td>' . $row['filename'] . '</td>';
                        echo '<td><center>' . $row['annee'] . '</center></td>';
                        echo '<td>' . $row['status'] . '</td>';
                        echo '<td style="width=130px;" class="d-flex justify-content-around">';
                        echo '<a href="' . $file_path . '" download><button class="btn btn-sm btn-outline-primary download_file" data-id="' . $row['id'] . '" type="button"><i class="fa fa-download"></i></button></a>';
                        if(isset($_SESSION['user'])){    
                            if (($row['status'] == 'valide') && ($_SESSION['user']['type'] == 'admin')) {
                                echo '<button class="btn btn-sm btn-outline-danger remove_emplois" data-id="' . $row['id'] . '" type="button"><i class="fa fa-trash"></i></button>';
                            }
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