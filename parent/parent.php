<?php
  include_once '../function/session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Espace Parents</title>
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
 <style>
    *{
    list-style: none;
   
}

  </style>


</head>

<body>
    <!-- HEADER -->
    <?php include '../public/inclouds/navbar.php' ?>
    <main>
    <h2>Espace Parents</h2>
        <center> 
            <div class="card bg-info w-50" >
            <div class="card-body">
                <ul>
                    <li><a href="absence.php" class="level text-light">Les Abscences</a>
                    </li>
                </ul>
            </div>
        </div>
        </center>
        
        <center>
           <div class="card bg-info w-50" >
            <div class="card-body">
                <ul>
                    <li><a href="observation.php" class="level  text-light">Les Observations</a>
                    </li>
                </ul>
            </div>
        </div> 
        </center>
        
    </main>
   

    <script src="../js/bootsrap1.js"></script>
    <script src="../js/bootsrap2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>