<?php
define("ROOT","http://localhost/habiba/")?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container px-5">
                    <a class="navbar-brand" href="<?= ROOT ?>public/index.php">CEM</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>public/index.php">Accueil</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>card/card.php">Notre Equipe</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>pedagogie/pedagogie.php">Pédagogie</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>parent/parent.php">Parents</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>service/services.php">Services</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>public/contact.php">Contact</a></li>
                       
                          
                          
                        </ul>



                    
                        <?php if(isset($_SESSION['user'])){ ?>
                            <a href="<?= ROOT ?>public/logout.php" class="btn btn-danger">Se déconnecter</a>
                      <?php   }else{ ?>
                        <a href="<?= ROOT ?>public/login.php" class="btn btn-info">Se connecter</a>
                        <?php }  ?>

                       
                    </div>
                </div>
            </nav>