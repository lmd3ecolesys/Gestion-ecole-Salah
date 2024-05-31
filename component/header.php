

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">CEM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Acceuil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../card/card.php">Notre Equipe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pedagogie/pedagogie.php">Pédagogie</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../parent/parent.php">Parents</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../service/services.php">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>

        </ul>
        <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="Recherche" placeholder="Recherche" aria-label="Recherche">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Recherche</button>
        </form> -->
        &nbsp;&nbsp;
        <?php
        if (isset($_SESSION['user']['type'])) {
            echo '<a class="btn btn-primary" href="../public/logout.php" role="button">LogOut</a>';
        } else {
            echo '<a class="btn btn-primary" href="../public/login.php" role="button">Login</a>';
        }
        ?>
    </div>
</nav>