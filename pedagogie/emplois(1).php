<?php
include '../database/dbcon.php';
include_once '../function/session.php'; ?>
<!DOCTYPE html>
<html>

<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <title>Emplois du temps</title>
  <link rel="stylesheet" href="../css/bootsrap.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
      $(".level").click(function() {
        var level = $(this).text().replace(/\s+/g, '');
        $("#groups-" + level).toggle(); // Toggle visibility of the group list
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
        var newHref = 'view_emplois.php?trimestre=' + encodeURIComponent(trimestre) + '&groupe=' + encodeURIComponent(groupe) + '&level=' + encodeURIComponent(level);
        window.location.href = newHref;
      });
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
        <h2>Emplois du Temps</h2>
      </div>
      <div class="col-md-6 text-right">
        <?php
          if (isset($_SESSION['user'])&&($_SESSION['user']['type']=='admin')){
            echo '<button id="addBtn" class="btn btn-primary">Ajouter</button>';
          }
        ?>
      </div>
    </div>
    <div id="add-emplois" class="container" style='display: none;'>
      <form action="add_emplois.php" class="needs-validation" method="post" enctype="multipart/form-data" id="emploisForm" novalidate>
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
          <label for="educativeYear">Année Scolaire</label>
          <input type="text" name="year" class="form-control" id="educativeYear" name="educativeYear" required>
          <div class="invalid-feedback">SVP, entrer l'année au format XXXX-XXXX !</div>
        </div>
        <div class="form-group">
          <label for="file">Choisir un fichier</label>
          <input type="file" class="form-control" id="file" name="file" accept=".pdf, .doc, .docx, .jpg, .jpeg, .png, .ppt, .pptx, .xls, .xlsx" required>
          <div class="invalid-feedback">SVP, Choisez un fichier!</div>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Envoyer</button>
      </form>
    </div>

    <center>
    <div class="card bg-info w-50">
      <div class="card-body">
        <li><a href="#groups-1ereAnnée" class="level text-light">1ere Année</a>
          <ul id="groups-1ereAnnée" style="display: none;">
            <div class="card" style="width: 18rem;">
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href='#trim-1AM1' class="group">1AM1</a>
                  <ul id="trim-1AM1" style="display: none;">
                    <li class="list-group-item"><a href='' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
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
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
                  </ul>
                </li>
                <li class="list-group-item"><a href='#trim-1AM4' class="group">1AM4</a>
                  <ul id="trim-1AM4" style="display: none;">
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </ul>
        </li>
      </div>
    </div>
    <div class="card bg-info w-50">
      <div class="card-body">
        <li><a href="#groups-2emeAnnée" class="level text-light">2eme Année</a>
          <ul id="groups-2emeAnnée" style="display: none;">
            <div class="card" style="width: 18rem;">
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href='#trim-2AM1' class="group">2AM1</a>
                  <ul id="trim-2AM1" style="display: none;">
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
                  </ul>
                </li>
                <li class="list-group-item"><a href='#trim-2AM2' class="group">2AM2</a>
                  <ul id="trim-2AM2" style="display: none;">
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
                  </ul>
                </li>
                <li class="list-group-item"><a href='#trim-2AM3' class="group">2AM3</a>
                  <ul id="trim-2AM3" style="display: none;">
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
                  </ul>
                </li>
                <li class="list-group-item"><a href='#trim-2AM4' class="group">2AM4</a>
                  <ul id="trim-2AM4" style="display: none;">
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </ul>
        </li>
      </div>
    </div>
    <div class="card bg-info w-50">
      <div class="card-body">
        <li><a href="#groups-3emeAnnée" class="level text-light">3eme Année</a>
          <ul id="groups-3emeAnnée" style="display: none;">
            <div class="card" style="width: 18rem;">
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href='#trim-3AM1' class="group">3AM1</a>
                  <ul id="trim-3AM1" style="display: none;">
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
                  </ul>
                </li>
                <li class="list-group-item"><a href='#trim-3AM2' class="group">3AM2</a>
                  <ul id="trim-3AM2" style="display: none;">
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
                  </ul>
                </li>
                <li class="list-group-item"><a href='#trim-3AM3' class="group">3AM3</a>
                  <ul id="trim-3AM3" style="display: none;">
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
                  </ul>
                </li>
                <li class="list-group-item"><a href='#trim-3AM4' class="group">3AM4</a>
                  <ul id="trim-3AM4" style="display: none;">
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </ul>
        </li>
      </div>
    </div>
    <div class="card bg-info w-50">
      <div class="card-body">
        <li><a href="#groups-4emeAnnée" class="level text-light">4eme Année</a>
          <ul id="groups-4emeAnnée" style="display: none;">
            <div class="card" style="width: 18rem;">
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href='#trim-4AM1' class="group">4AM1</a>
                  <ul id="trim-4AM1" style="display: none;">
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
                  </ul>
                </li>
                <li class="list-group-item"><a href='#trim-4AM2' class="group">4AM2</a>
                  <ul id="trim-4AM2" style="display: none;">
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
                  </ul>
                </li>
                <li class="list-group-item"><a href='#trim-4AM3' class="group">4AM3</a>
                  <ul id="trim-4AM3" style="display: none;">
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
                  </ul>
                </li>
                <li class="list-group-item"><a href='#trim-4AM4' class="group">4AM4</a>
                  <ul id="trim-4AM4" style="display: none;">
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">1er trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">2eme trimestre</a></li>
                    <li class="list-group-item"><a href='view_emplois.php' class="lien">3eme trimestre</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </ul>
        </li>
      </div>
    </div>


    
    
</center>
  </main>
  <br>
  <!-- HEADER -->
  <style>
    *{
    list-style: none;
   
}

  </style>
  <script src="../js/bootsrap1.js"></script>
  <script src="../js/bootsrap2.js"></script>
</body>

</html>