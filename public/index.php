<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>CEM - Accueil</title>

    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <link href="css/styles.css" rel="stylesheet" />
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">

        <?php include_once "inclouds/navbar.php"; ?>

        <header class="bg-dark py-5">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center">
                    <div class="col-lg-8 col-xl-7 col-xxl-6">
                        <div class="my-5 text-center text-xl-start">
                            <h1 class="display-5 fw-bolder text-white mb-2">CEM Madrassati</h1>
                            <p class="lead fw-normal text-white-50 mb-4">Bienvenue sur le site officiel de l'école Madrassati</p>
                            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="<?= ROOT ?>public/assets/school.png" alt="..." /></div>
                </div>
            </div>
        </header>

        <section class="py-5 bg-light" id="scroll-target">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="<?= ROOT ?>public/assets/img1.jpg" alt="..." /></div>
                    <div class="col-lg-6">
                        <h2 class="fw-bolder" style="text-transform: uppercase;">Règlement intérieur de cem </h2>
                        <p class="lead fw-normal text-muted mb-0">Saluer le drapeau est un devoir national.
                            Prendre soin d'un carnet de correspondance et l'apporter est obligatoire.
                            Les étudiants doivent disposer des livres et des outils requis pour chaque matière, ainsi que de l'uniforme sportif pour le cours d'éducation physique.
                            Il est strictement interdit aux étudiants d'apporter des téléphones ou tout autre objet qui n'est pas lié aux études..</p>
                    </div>
                </div>
            </div>
        </section>


        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-first order-lg-last"><img class="img-fluid rounded mb-5 mb-lg-0" src="<?= ROOT ?>public/assets/img2.jpg" alt="..." /></div>
                    <div class="col-lg-6">
                        <h2 class="fw-bolder">HISTORIQUE DE CEM</h2>
                        <p class="lead fw-normal text-muted mb-0">
                            Collège d'enseignement moyen (CEM), en arabe : طور التعليم المتوسط, aussi appelé enseignement moyen en Algérie, est une étape d'enseignement, durant de quatre ans après les cinq ans de l'enseignement primaire. À la fin de la scolarité et après un examen final ouvrant droit à l’obtention d’un diplôme  appelé brevet d’enseignement moyen, l'élève est admis automatiquement en 1re année secondaire </p>
                    </div>
                </div>
            </div>
        </section>





        <section class="py-5" id="features">
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h2 class="fw-bolder mb-0">La meilleure CEM de.</h2>
                    </div>
                    <div class="col-lg-8">
                        <div class="row gx-5 row-cols-1 row-cols-md-2">
                            <div class="col mb-5 h-100">
                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-trash"></i></div>
                                <h2 class="h5">Propreté</h2>

                            </div>
                            <div class="col mb-5 h-100">
                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                                <h2 class="h5">Éducation</h2>

                            </div>
                            <div class="col mb-5 mb-md-0 h-100">
                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-slack"></i></div>
                                <h2 class="h5">les activités</h2>

                            </div>
                            <div class="col h-100">
                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-star"></i></div>
                                <h2 class="h5">Excellents étudiants</h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



<section>
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12777.196520517284!2d7.7155669576416175!3d36.8113513148342!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12f009d157eeab93%3A0xd4fe680f7ef37362!2sD%C3%A9partement%20informatique!5e0!3m2!1sen!2sus!4v1712945823135!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>





    </main>


    <?php include_once "inclouds/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/scripts.js"></script>
</body>

</html>