<?php
include_once '../database/dbcon.php';
include_once '../function/session.php';
?>

<!DOCTYPE html>
<html>

<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>Planning</title>
    <link rel="stylesheet" href="../css/bootsrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script>
        $(document).ready(function() {
            $("#addExm").click(function() {
                $("#add-exm").toggle();
                var buttonClass = $("#add-exm").is(":visible") ? "btn btn-danger" : "btn btn-primary";
                $(this).removeClass();
                $(this).addClass(buttonClass);
            });
            $("#addDev").click(function() {
                $("#add-dev").toggle();
                var buttonClass = $("#add-dev").is(":visible") ? "btn btn-danger" : "btn btn-primary";
                $(this).removeClass();
                $(this).addClass(buttonClass);
            });
            $(".level").click(function() {
                var level = $(this).text().replace(/\s+/g, '');
                $("#groups-" + level).toggle(); // Toggle visibility of the group list
            });
            $(".ex-level").click(function() {
                var level = $(this).text().replace(/\s+/g, '');
                $("#" + level).toggle(); // Toggle visibility of the group list
            });
            $(".group").click(function() {
                var group = $(this).text().replace(/\s+/g, '');
                $("#trim-" + group).toggle(); // Toggle visibility of the group list
            });
            $(".lien").click(function(e) {
                console.log('lien clicked');
                e.preventDefault(); // Prevent default link behavior
                var trimestre = $(this).text();
                var groupe = $(this).parent().parent().prev().text();
                var level = $(this).parent().parent().parent().parent().parent().parent().prev().text();
                var newHref = 'devoir.php?trimestre=' + encodeURIComponent(trimestre) + '&groupe=' + encodeURIComponent(groupe) + '&level=' + encodeURIComponent(level);
                window.location.href = newHref;
            });
            $(".ex-lien").click(function(e) {
                console.log('lien clicked');
                e.preventDefault(); // Prevent default link behavior
                var trimestre = $(this).text();
                var level = $(this).parent().parent().prev().text();
                var newHref = 'examen.php?trimestre=' + encodeURIComponent(trimestre) + '&level=' + encodeURIComponent(level);
                window.location.href = newHref;
            });

            //$(".selector").flatpickr(optional_config);

            // Form validation using Bootstrap
            $('#emploisForm').on('submit', function(event) {
                var educativeYear = $('#educativeYear').val();
                var educativeYearPattern = /^[0-9]{4}-[0-9]{4}$/;
                if (!educativeYearPattern.test(educativeYear)) {
                    event.preventDefault();
                    event.stopPropagation();
                    $('#educativeYear').addClass('is-invalid');
                } else {
                    $('#educativeYear').removeClass('is-invalid');
                }
                if (this.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                $(this).addClass('was-validated');
            });
            // $('#devForm').on('submit', function(event) {
            //     var educativeYear = $('#educativeYear').val();
            //     var educativeYearPattern = /^[0-9]{4}-[0-9]{4}$/;
            //     if (!educativeYearPattern.test(educativeYear)) {
            //         event.preventDefault();
            //         event.stopPropagation();
            //         $('#educativeYear').addClass('is-invalid');
            //     } else {
            //         $('#educativeYear').removeClass('is-invalid');
            //     }
            //     if (this.checkValidity() === false) {
            //         event.preventDefault();
            //         event.stopPropagation();
            //     }
            //     $(this).addClass('was-validated');
            // });
        });
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

        #add-emplois {
            margin: 20px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <?php include '../public/inclouds/navbar.php' ?>
    <br>
    <main>
        <div class="row">
            <div class="col-md-6">
                <h2>Planning des Examens et Devoir</h2>
            </div>
            <div class="col-md-6 text-right">
                <?php
                if (isset($_SESSION['user'])) {
                    if ($_SESSION['user']['type'] == "admin") {
                        echo '<button id="addExm" class="btn btn-primary">+&nbsp;Examen</i></button>';
                    }

                    if (($_SESSION['user']['type'] == "admin") || ($_SESSION['user']['type'] == "enseignant")) {
                        echo '&nbsp&nbsp<button id="addDev" class="btn btn-primary">+&nbsp;Devoir</i></button>';
                    }
                }
                ?>
            </div>
        </div>
        <br>
        <div id="add-exm" class="container" style='display: none;'>
            <h3>Ajouter un examen</h3>
            <form action="add_examen.php" class="needs-validation" method="post" enctype="multipart/form-data" id="emploisForm" novalidate>
                <div class="form-group">
                    <label for="educationLevel">Niveau d'étude</label>
                    <select name="level" class="form-control" id="educationLevel">
                        <option value="1ere Année">1ere Année</option>
                        <option value="2eme Année">2eme Année</option>
                        <option value="3eme Année">3eme Année</option>
                        <option value="4eme Année">4eme Année</option>
                    </select>
                    <div class="invalid-feedback">SVP, selectionnez un niveau !</div>
                </div>
                <div class="form-group">
                    <label for="trimestre">trimestre</label>
                    <select name="trimestre" class="form-control" id="trimestre" onchange="">
                        <option value="1er trimestre">1er trimestre</option>
                        <option value="2eme trimestre">2eme trimestre</option>
                        <option value="3eme trimestre">3eme trimestre</option>
                    </select>
                    <div class="invalid-feedback">SVP, selectionnez un trimestre !</div>
                </div>
                <div class="form-group">
                    <label for="educativeYear">Année Scolaire</label>
                    <input type="text" name="year" class="form-control" id="educativeYear" name="annee" required>
                    <div class="invalid-feedback">SVP, entrer l'année au format XXXX-XXXX !</div>
                </div>
                <div class="form-group">
                    <label for="file">Choisir un fichier</label>
                    <input type="file" class="form-control" id="file" name="file" accept=".pdf, .doc, .docx, .jpg, .jpeg, .png, .ppt, .pptx, .xls, .xlsx" required>
                    <div class="invalid-feedback">SVP, Choisez un fichier!</div>
                </div>
                <button type="submit" class="btn btn-primary" name="examen">Ajouter</button>
            </form>
        </div>
        <br>
        <div id="add-dev" class="container" style='display: none;'>
            <h3>Ajouter un devoir</h3>
            <form action="add_devoir.php" class="needs-validation" method="post" enctype="multipart/form-data" id="devForm" novalidate>
                <div class="form-group">
                    <label for="educationLevel">Niveau d'étude</label>
                    <select name="level" class="form-control" id="educationLevel" onchange="updateGroupDropdown()">
                        <option value="1ere Année">1ere Année</option>
                        <option value="2eme Année">2eme Année</option>
                        <option value="3eme Année">3eme Année</option>
                        <option value="4eme Année">4eme Année</option>
                    </select>
                    <div class="invalid-feedback">SVP, selectionnez un niveau !</div>
                </div>
                <div class="form-group">
                    <label for="trimestre">trimestre</label>
                    <select name="trimestre" class="form-control" id="trimestre" onchange="">
                        <option value="1er trimestre">1er trimestre</option>
                        <option value="2eme trimestre">2eme trimestre</option>
                        <option value="3eme trimestre">3eme trimestre</option>
                    </select>
                    <div class="invalid-feedback">SVP, selectionnez un trimestre !</div>
                </div>
                <div class="form-group">
                    <label for="group">Groupe</label>
                    <select class="form-control" id="group" name="group">
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
                <div class="form-group">
                    <label for="matiere">Matière</label>
                    <select class="form-control" id="matiere" name="matiere">
                        <!-- Options will be dynamically populated based on the selected education level -->
                        <option value="Langue Arabe">Langue Arabe</option>
                        <option value="Langue française">Langue française</option>
                        <option value="Langue anglaise">Langue anglaise</option>
                        <option value="Langue anglaise">Langue amazight</option>
                        <option value="Mathématiques">Mathématiques</option>
                        <option value="Sciences naturelles">Sciences naturelles</option>
                        <option value="Physique">Physique</option>
                        <option value="l'éducation islamique">l'éducation islamique</option>
                        <option value="Histoire et Géographie">Histoire et Géographie</option>
                        <option value="Éducation civique">Éducation civique</option>
                        <option value="Art Education">Art Education</option>
                        <option value="L'Éducation musicale">L'Éducation musicale</option>
                        <option value="Éducation physique sport">Éducation physique sport</option>
                        <option value="Informatique">Informatique</option>
                    </select>
                    <div class="invalid-feedback">SVP, selectionnez une matière !</div>
                </div>
                <div class="form-group">
                    <label for="educativeYear">Année Scolaire</label>
                    <input type="text" name="year" class="form-control educativeYear" name="year" required>
                    <div class="invalid-feedback">SVP, entrer l'année au format XXXX-XXXX !</div>
                </div>
                <div class="form-group">
                    <label for="date">Date du devoir</label>
                    <input type="datetime-local" name="date" id="date" class="form-control timepicker" name="date" placeholder="sélectionez une date" required>
                    <small id="helpId" class="text-muted">un groupe passe seulement deux (2) devoirs par jour</small>
                    <div class="invalid-feedback">SVP, entrez la date du devoir !</div>
                </div>
                <div class="form-group">
                    <label for="enseignant">Enseignant</label>
                    <select name="ens" class="form-control" id="enseignant">
                        <?php
                        $ens = $con->query("SELECT * FROM user WHERE type='enseignant'");
                        foreach ($ens as $en) {
                            echo '<option value="' . $en["id"] . '">' . $en["nom"] . ' ' . $en["prenom"] . '</option>';
                        }
                        $con->close();
                        ?>
                    </select>
                    <div class="invalid-feedback">SVP, selectionnez un enseignant !</div>
                </div>
                <button type="submit" class="btn btn-primary" name="devoir">Ajouter</button>
            </form>
        </div>
        <div id="examens" class="container">
            <h2>Les Examens</h2>
            <div class="card">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href='#1ereAnnée' class="ex-level">1ere Année</a>
                            <ul id="1ereAnnée" style="display: none;">
                                <li class="list-group-item"><a href='#trim-1AM1' class="ex-trim ex-lien">1er trimestre</a></li>
                                <li class="list-group-item"><a href='#trim-1AM2' class="ex-trim ex-lien">2eme trimestre</a></li>
                                <li class="list-group-item"><a href='#trim-1AM3' class="ex-trim ex-lien">3eme trimestre</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item"><a href='#2emeAnnée' class="ex-level">2eme Année</a>
                            <ul id="2emeAnnée" style="display: none;">
                                <li class="list-group-item"><a href='#trim-2AM1' class="ex-trim ex-lien">1er trimestre</a></li>
                                <li class="list-group-item"><a href='#trim-2AM2' class="ex-trim ex-lien">2eme trimestre</a></li>
                                <li class="list-group-item"><a href='#trim-2AM3' class="ex-trim ex-lien">3eme trimestre</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item"><a href='#3emeAnnée' class="ex-level">3eme Année</a>
                            <ul id="3emeAnnée" style="display: none;">
                                <li class="list-group-item"><a href='#trim-3AM1' class="ex-trim ex-lien">1er trimestre</a></li>
                                <li class="list-group-item"><a href='#trim-3AM2' class="ex-trim ex-lien">2eme trimestre</a></li>
                                <li class="list-group-item"><a href='#trim-3AM3' class="ex-trim ex-lien">3eme trimestre</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item"><a href='#4emeAnnée' class="ex-level">4eme Année</a>
                            <ul id="4emeAnnée" style="display: none;">
                                <li class="list-group-item"><a href='#trim-4AM1' class="ex-trim ex-lien">1er trimestre</a></li>
                                <li class="list-group-item"><a href='#trim-4AM2' class="ex-trim ex-lien">2eme trimestre</a></li>
                                <li class="list-group-item"><a href='#trim-4AM3' class="ex-trim ex-lien">3eme trimestre</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="dev" class="container">
            <h2>Les Devoirs</h2>
            <div class="card">
                <div class="card-body">
                    <li><a href="#groups-1ereAnnée" class="level">1ere Année</a>
                        <ul id="groups-1ereAnnée" style="display: none;">
                            <div class="card" style="width: 18rem;">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a href='#trim-1AM1' class="group">1AM1</a>
                                        <ul id="trim-1AM1" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item"><a href='#trim-1AM2' class="group">1AM2</a>
                                        <ul id="trim-1AM2" style="display: none;">
                                            <li class="list-group-item"><a href='#' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='#' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='#' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item"><a href='#trim-1AM3' class="group">1AM3</a>
                                        <ul id="trim-1AM3" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item"><a href='#trim-1AM4' class="group">1AM4</a>
                                        <ul id="trim-1AM4" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </ul>
                    </li>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <li><a href="#groups-2emeAnnée" class="level">2eme Année</a>
                        <ul id="groups-2emeAnnée" style="display: none;">
                            <div class="card" style="width: 18rem;">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a href='#trim-2AM1' class="group">2AM1</a>
                                        <ul id="trim-2AM1" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item"><a href='#trim-2AM2' class="group">2AM2</a>
                                        <ul id="trim-2AM2" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item"><a href='#trim-2AM3' class="group">2AM3</a>
                                        <ul id="trim-2AM3" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item"><a href='#trim-2AM4' class="group">2AM4</a>
                                        <ul id="trim-2AM4" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </ul>
                    </li>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <li><a href="#groups-3emeAnnée" class="level">3eme Année</a>
                        <ul id="groups-3emeAnnée" style="display: none;">
                            <div class="card" style="width: 18rem;">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a href='#trim-3AM1' class="group">3AM1</a>
                                        <ul id="trim-3AM1" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item"><a href='#trim-3AM2' class="group">3AM2</a>
                                        <ul id="trim-3AM2" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item"><a href='#trim-3AM3' class="group">3AM3</a>
                                        <ul id="trim-3AM3" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item"><a href='#trim-3AM4' class="group">3AM4</a>
                                        <ul id="trim-3AM4" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </ul>
                    </li>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <li><a href="#groups-4emeAnnée" class="level">4eme Année</a>
                        <ul id="groups-4emeAnnée" style="display: none;">
                            <div class="card" style="width: 18rem;">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a href='#trim-4AM1' class="group">4AM1</a>
                                        <ul id="trim-4AM1" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item"><a href='#trim-4AM2' class="group">4AM2</a>
                                        <ul id="trim-4AM2" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item"><a href='#trim-4AM3' class="group">4AM3</a>
                                        <ul id="trim-4AM3" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item"><a href='#trim-4AM4' class="group">4AM4</a>
                                        <ul id="trim-4AM4" style="display: none;">
                                            <li class="list-group-item"><a href='devoir.php' class="lien">1er trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">2eme trimestre</a></li>
                                            <li class="list-group-item"><a href='devoir.php' class="lien">3eme trimestre</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </main>
    <br>
    <!-- HEADER -->
   
    <script src="../js/bootsrap1.js"></script>
    <script src="../js/bootsrap2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        var config = {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        }
        flatpickr("input[type=datetime-local]", config);
    </script>
</body>

</html>