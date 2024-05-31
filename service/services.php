<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootsrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/service_card.css">
    <title>Services</title>
</head>

<body>
    <!-- HEADER -->
    <?php include '../public/inclouds/navbar.php' ?>
    <ul class="cards">
        <!-- Transport -->
        <li>
            <a href="service_detail.php?type=transport" class="card">
                <img src="../images/bus.jpg" class="card__image" alt="" />
                <div class="card__overlay">
                    <div class="card__header">
                        <svg class="card__arc" xmlns="">
                            <path />
                        </svg>
                        <img class="card__thumb" src="https://i.imgur.com/7D7I6dI.png" alt="" />
                        <div class="card__header-text">
                            <h3 class="card__title">Service Transport</h3>
                        </div>
                    </div>
                    <p class="card__description">Cliquer ici pour voir les horaires de démmarage de notre transport</p>
                </div>
            </a>
        </li>

        <!-- Cantine -->
        <li>
            <a href="service_detail.php?type=cantine" class="card">
                <img src="../images/cantine.jpg" class="card__image" alt="" />
                <div class="card__overlay">
                    <div class="card__header">
                        <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
                            <path />
                        </svg>
                        <img class="card__thumb" src="https://i.imgur.com/7D7I6dI.png" alt="" />
                        <div class="card__header-text">
                            <h3 class="card__title">Service Cantine</h3>
                        </div>
                    </div>
                    <p class="card__description">Cliquer ici pour voir les horaires d'ouverture et de fermetture de notre Cantine</p>
                </div>
            </a>
        </li>

        <!-- Clinique -->
        <li>
            <a href="service_detail.php?type=clinique" class="card">
                <img src="../images/santé.jpg" class="card__image" alt="" />
                <div class="card__overlay">
                    <div class="card__header">
                        <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
                            <path />
                        </svg>
                        <img class="card__thumb" src="https://i.imgur.com/7D7I6dI.png" alt="" />
                        <div class="card__header-text">
                            <h3 class="card__title">Service Clinique Scolaire</h3>
                        </div>
                    </div>
                    <p class="card__description">Cliquer ici pour voir les horaires d'ouverture et de fermetture de notre cabinet médicale</p>
                </div>
            </a>
        </li>

        <!-- Bibliothèque -->
        <li>
            <a href="service_detail.php?type=bibliothèque" class="card">
                <img src="../images/bibliotheque.jpg" class="card__image" alt="" />
                <div class="card__overlay">
                    <div class="card__header">
                        <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
                            <path />
                        </svg>
                        <img class="card__thumb" src="https://i.imgur.com/7D7I6dI.png" alt="" />
                        <div class="card__header-text">
                            <h3 class="card__title">Services du bibliothèque</h3>
                        </div>
                    </div>
                    <p class="card__description">Cliquer ici pour voir les horaires d'ouverture et de fermetture de notre bibliotheèque</p>
                </div>
            </a>
        </li>
    </ul>
    <!-- FOOTER -->
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../js/bootsrap1.js"></script>
    <script src="../js/bootsrap2.js"></script>
</body>

</html>