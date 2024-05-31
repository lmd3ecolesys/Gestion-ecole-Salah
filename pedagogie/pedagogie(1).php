<?php
  include_once '../database/dbcon.php';
  include_once '../function/session.php';
?>

<!DOCTYPE html>
<html>

<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <title>Pedagogy</title>
  <link rel="stylesheet" href="../css/bootsrap.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    $(document).ready(function() {
      $(".level").click(function() {
        var level = $(this).text();
        $("#groups-" + level).toggle(); // Toggle visibility of the group list
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
  </style>
</head>

<body>
  <!-- HEADER -->
  <?php include '../public/inclouds/navbar.php' ?>
  <main>
    <h2>Pédagogie</h2>
 <center>
    <div class="card bg-info w-50">
      <div class="card-body">
        <ul>
          <li><a href="emplois.php" class="level text-light">Emplois Du Temps</a>
          </li>
        </ul>
      </div>
    </div>
     

    <div class="card bg-info w-50">
      <div class="card-body">
        <ul>
          <li><a href="student_list.php" class="level text-light">Listes Des Éleves</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="card bg-info w-50">
      <div class="card-body">
        <ul>
          <li><a href="planning.php" class="level text-light">Planning Des Examens</a>
          </li>
        </ul>
      </div>
    </div>
    <?php
    if ((isset($_SESSION['user']))&&($_SESSION['user']['type']=='admin')){
    ?>
    <div class="card bg-info w-50">
      <div class="card-body">
        <ul>
          <li><a href="teachers_list.php" class="level text-light">Liste Des Utilisateurs</a>
          </li>
        </ul>
      </div>
    </div>
    <?php
    }
    ?></center>
  </main>
  <!-- FOOTER -->
  
  <style>
    *{
    list-style: none;
   
}

  </style>

  <script src="../js/bootsrap1.js"></script>
  <script src="../js/bootsrap2.js"></script>
</body>

</html>