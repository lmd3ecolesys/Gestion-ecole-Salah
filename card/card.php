<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cartes</title>
    <link rel="stylesheet" href="../css/bootsrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <div class="container">
            <h1></h1>
            <div class="row text-center">
                <?php
                $cards = $con->query('SELECT * FROM user WHERE type!="parent" ');
                if ($cards->num_rows > 0) {
                    while ($row = $cards->fetch_assoc()) {
                ?>
                        <!-- Team item -->
                        <div class="col-xl-3 col-sm-6 mb-5">
                            <div id='card' class="bg-white rounded shadow-sm py-5 px-4"><img src="../images/prof.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                                <h5 class="mb-0"><?php echo $row['nom'] . " " . $row['prenom'] ?></h5><span class="small text-uppercase text-muted"><?php echo $row['type'] ?></span>
                                <ul class="social mb-0 list-inline mt-3">
                                    <li class="list-inline-item "><?php echo $row['email'] ?></li>
                                    <li class="list-inline-item"><?php echo $row['tel'] ?></li>
                                </ul>
                            </div>
                        </div><!-- End -->
                <?php
                    }
                } else {
                    // No data found, display a Bootstrap alert
                    echo "<div class='alert alert-warning' role='alert'>un utilisateur est trouvé</div>";
                }
                ?>
            </div>
        </div>
    </main>
    <!-- FOOTER -->

    <style>
      
    </style>
   

    <?php include '../public/inclouds/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../js/bootsrap1.js"></script>
    <script src="../js/bootsrap2.js"></script>
</body>

</html>