<?php
// Start session
session_start();

// Include database connection
include_once '../database/dbcon.php'; // Adjust this to match your database connection file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username, password, and type from form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    // SQL query to fetch user from database (use prepared statements to prevent SQL injection)
    $sql = "SELECT * FROM user WHERE username = ? AND password = ? AND type = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $username, $password, $type);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if user exists in database
    if (mysqli_num_rows($result) == 1) {
        // User exists, store user data in session
        $_SESSION['user'] = mysqli_fetch_assoc($result);
        print_r($_SESSION['user']['type']);
        // Redirect user based on type
        switch ($type) {
            case 'admin':
                header("Location: ../pedagogie/pedagogie.php");
                break;
            case 'parent':
                header("Location: ../parent/parent.php");
                break;
            case 'enseignant':
                header("Location: ../pedagogie/pedagogie.php");
                break;
            default:
                // Redirect to a default page if type is not recognized
                header("Location: ../public/login.php");
        }
        exit(); // Stop further execution
    } else {
        // User doesn't exist, display error message or redirect to login page with error
        $error_message = "Username ou Password est incorrecte !";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content />
        <meta name="author" content />
        <title>CEM - Login</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <?php include_once "inclouds/navbar.php"; ?>
            <!-- Page content-->
            <section class="py-5">
                <div class="container px-5">
                    <!-- Contact form-->
                    <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5" style="background-image: url('../images/d.png');background-repeat:no-repeat">
                        <div class="text-center mb-5" >
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person"></i></div>
                            <h1 class="fw-bolder">Login</h1>
                            <?php if (isset($error_message)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>
                        </div>
                        
                        <div  class="row gx-5 justify-content-center" >
                            <div class="col-lg-8 col-xl-6" >
                              
                                <form id="contactForm" method="POST" action="" >
                                    <!-- Name input-->
                                    <div class="form-floating mb-3" > 
                                        <input class="form-control" name="username" id="name" type="text" placeholder="Usrname" data-sb-validations="required" />
                                        <label for="email">Username</label>
                                        <div class="invalid-feedback" data-sb-feedback="email:required">A email is required.</div>
                                    </div>
                                    <!-- Email address input-->
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="password" id="password" type="password" placeholder="name@example.com" data-sb-validations="required,email" />
                                        <label for="password">Password</label>
                                        <div class="invalid-feedback" data-sb-feedback="password:required">An password is required.</div>
                                        <div class="invalid-feedback" data-sb-feedback="password:email">password is not valid.</div>
                                    </div>


                                 <select class="form-select" name="type" aria-label="Default select example">
                                   <option selected >Role?</option>
                                   <option value="parent">Parent</option>
                                    <option value="admin">Admin</option>
                                    <option value="enseignant">Enseignant</option>
                                 </select>

                                 <br>


                                  
                                    <!-- Submit error message-->
                                    <!---->
                                    <!-- This is what your users will see when there is-->
                                    <!-- an error submitting the form-->
                                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                                    <!-- Submit Button-->
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-lg " id="submitButton" name="submit" type="submit">Login</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Contact cards-->
                  
                </div>
            </section>
        </main>
        <!-- Footer-->
        <?php include_once "inclouds/footer.php"; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
