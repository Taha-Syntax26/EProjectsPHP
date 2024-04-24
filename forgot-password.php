<?php
require 'Connection/connection.php';
?>

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $email = $_POST['forget-pass-mail'];

        // Check if the email exists in the database
        $check_email_query = "SELECT * FROM `register` WHERE email = :email";
        $check_email_prepare = $connection->prepare($check_email_query);
        $check_email_prepare->bindValue(":email", $email);
        $check_email_prepare->execute();
        $user = $check_email_prepare->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Email exists in the database
            $verification_code = mt_rand(1000, 9999); // Generate a 4-digit random code
            // Send the code to the provided email
            // (Your PHPMailer code to send the email goes here)

            //Load Composer's autoloader
            require 'vendor/autoload.php';
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
            $user_name = $user['first_name'];
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'mtaha080204@gmail.com';                     //SMTP username
                $mail->Password   = 'hlkx cmrn ksvy kmyr';                               //SMTP password
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('mtaha080204@gmail.com', 'SRS Electrical Appliances');
                $mail->addAddress($email, $user_name);     //Add a recipient
                $range = rand(10, 100);
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'SRS Electrical Appliances sent a verification code';
                $mail->Body = 'Hello ' . $user_name . ',<br>Your verification code is: ' . $verification_code;
                $mail->AltBody = `This is the body in plain text for non-HTML mail clients`;

                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            // Start the session and store the verification code
            session_start();
            $_SESSION['verification_code'] = $verification_code;
            $_SESSION['user_email'] = $email;

            // Redirect to the verification code input page
            header("Location: verified-code.php");
            exit();
        } else {
            // Email doesn't exist in the database
            echo "Email not found. Please check your email and try again.";
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
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="forget-pass-mail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" value="Reset Password">

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