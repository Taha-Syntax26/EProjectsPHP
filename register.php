<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<?php
require 'Connection/connection.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat_password'];
        $role = $_POST['role'];

        if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($role) || empty($repeat_password)) {
            echo "<script>alert('Please fill in all the required fields.')</script>";
        } else {
            if ($password !== $repeat_password) {
                echo "<script>alert('Passwords do not match. Please try again.')</script>";
            } else {
                // Check if the email already exists in the database
                $check_email_query = "SELECT COUNT(*) FROM `register` WHERE `email` = :email";
                $check_email_query_prepare = $connection->prepare($check_email_query);
                $check_email_query_prepare->bindParam(':email', $email);
                $check_email_query_prepare->execute();
                $email_exists = $check_email_query_prepare->fetchColumn();

                if ($email_exists > 0) {
                    echo "<script>alert('Email already exists. Please use a different email.')</script>";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $register_query = "INSERT INTO `register` (`user_id`, `first_name`, `last_name`, `email`, `password`, `repeat_password` ,`role`) VALUES (:user_id, :first_name, :last_name, :email, :hashedPassword, :repeat_password ,:role)";
                    $register_query_prepare = $connection->prepare($register_query);
                    $register_query_prepare->bindParam(':user_id', $user_id);
                    $register_query_prepare->bindParam(':first_name', $first_name);
                    $register_query_prepare->bindParam(':last_name', $last_name);
                    $register_query_prepare->bindParam(':email', $email);
                    $register_query_prepare->bindParam(':hashedPassword', $hashedPassword);
                    $register_query_prepare->bindParam(':repeat_password', $repeat_password);
                    $register_query_prepare->bindParam(':role', $role);
                    $register_query_prepare->execute();
                    header('location:login.php');
                }
            }
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="register.php" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            name="first_name" placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            name="last_name" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        name="email" placeholder="Email Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" name="password" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" name="repeat_password"
                                            placeholder="Repeat Password">
                                    </div>
                                </div>
                                <div class="form-check mx-2">
                                    <input class="form-check-input" type="radio" value="worker" name="role" id="flexRadioDefault1"
                                        checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Worker
                                    </label>
                                </div>
                                <div class="form-check mb-2 mx-2">
                                    <input class="form-check-input" type="radio" value="tester" name="role" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Tester
                                    </label>
                                </div>
                                <input type="submit" value="Register Account" class="btn btn-primary btn-user btn-block"
                                    name="submit">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>