<?php
require 'Connection/connection.php';
?>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        if (isset($_SESSION['user_email'])) {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            if ($new_password === $confirm_password) {
                // Passwords match, proceed to update
                // You may need to hash the password before storing it in the database for security
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the password in the database for the user associated with the provided email
                $update_query = "UPDATE `register` SET password = :password WHERE email = :email";
                $update_prepare = $connection->prepare($update_query);
                $update_prepare->bindValue(":password", $hashed_password);
                $update_prepare->bindValue(":email", $_SESSION['user_email']);
                $update_prepare->execute();

                // Password updated, you can redirect the user to a success page or login page
                header("Location: login.php");
                exit();
            } else {
                echo "Passwords do not match. Please re-enter your new password.";
            }
        } else {
            // Handle session data not found or unexpected condition
            echo "Session data not found. Please go through the proper flow to reset your password.";
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

    <title>SB Admin 2 - Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">New Paasword</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <!-- HTML Form for New Password Entry -->
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="new_password" id="newPassword" aria-describedby="newPasswordHelp" placeholder="Enter New Password..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="confirm_password" id="confirmPassword" aria-describedby="confirmPasswordHelp" placeholder="Repeat New Password..." required>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" value="Submit">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
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