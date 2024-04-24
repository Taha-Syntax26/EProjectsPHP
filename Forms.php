<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!-- PHP for Connection -->
<?php
require 'Connection/connection.php';
?>




 



<!-- PHP for Changing h1 -->

<?php

// Get the product name from the URL
$productName = $_GET['name'];

$Formtitle = '<h1 style="color: rgba(31, 28, 28, 0.726);" class="h3 mb-4 font-weight-bold text-center">' . $productName . ' Testing</h1>';

$uniqueCode = substr(str_shuffle("0123456789"), 0, 10);


?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Jquery Cdn -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>


  

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Navbar Start -->

        <?php require 'header/navbar.php' ?>

        <!-- Navbar End -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 style="color: rgba(31, 28, 28, 0.726);" class="h3 mb-4 font-weight-bold text-center"><?php echo $Formtitle ?></h1>

            <hr>

            <!-- Form Start -->
            <div class="container mt-5 p-container">
                <div class="row ">
                    <div class="col-lg-7 mx-auto">
                        <div class="card mt-2 mx-auto p-4 bg-light">
                            <div class="card-body bg-light">

                                <div class="container">
                                    <form id="myForm" role="form" method="post">



                                        <div class="controls">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="form_name">Product ID</label>
                                                        <input type="text" class="form-control" value="<?php echo $uniqueCode ?>" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="form_name">User Name</label>
                                                        <input id="username" type="text" name="username" class="form-control" required="required" data-error="Username is required.">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="form_email">Date</label>
                                                        <input type="date" name="date" id="date" class="form-control" required="required" data-error="date is required.">

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="form_need">Testing Type</label>
                                                        <select  id="testing-type" name="testing-type" class="form-control" required="required" data-error="Please specify your need.">
                                                            <option value="" selected disabled>--Select Your Issue--</option>
                                                            <option>Voltage Test</option>
                                                            <option>Capacity Test</option>
                                                            <option>Time-Current Test</option>
                                                            <option>Insulation Test</option>
                                                            <option>Other</option>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="form_message">Description</label>
                                                        <textarea  id="desc" name="desc" class="form-control" placeholder="Write your message here." rows="4" required="required" data-error="Please, leave us a message."></textarea>
                                                    </div>

                                                </div>


                                                <div class="col-md-12">

                                                    <input type="submit" class="btn btn-primary btn-send  pt-2 btn-block
                                                    " value="Send For Testing" name="submit" id="submitBtn">

                                                </div>

                                            </div>


                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                        <!-- /.8 -->

                    </div>
                    <!-- /.row-->

                </div>
            </div>
            <!-- Form End -->



        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <?php require 'header/footer.php' ?>
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
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
    
         
    
    
    <!-- Ajax For Stop reloading -->
<script>
    $(document).ready(function() {
        $("#myForm").submit(function(event) {
            event.preventDefault();
            // Get form data
            let productUniqueId = "<?php echo $uniqueCode ?>";
            let productName = "<?php echo $productName ?>";
            let username = $('#username').val();
            let date = $('#date').val();
            let testingtype = $('#testing-type').val();
            let desc = $('#desc').val();
            // Send the data to the server using AJAX
            $.ajax({
                type: 'POST', // You can use POST or GET, depending on your server-side script
                url: 'productForm.php', // Replace with the URL of your server-side script
                data: {
                    productUniqueId: productUniqueId,
                    productName: productName,
                    username: username,
                    date: date,
                    testingtype: testingtype,
                    desc: desc
                },
                success: function(response) {
                    // Handle the server response here (if needed)
                    let form = document.getElementById("myForm");
                    form.reset();
                }
            });
        });

    });


</script>











<!--  For sending data with ajayx without refresh -->



<script>
    // For Loading body data when clickng on navbar links

    $(document).ready(function() {
        function initializeEventHandlers() {
            // Handle navbar link clicks
            $('.load-body').on('click', function(e) {
        e.preventDefault(); // Prevent the default link behavior

        var page = $(this).attr('href'); // Get the URL from the href attribute

  // Use the History API to update the URL
        history.pushState(null, null, page);

  // Load the content into the #wrapper element
       $('#page-top').load(page, function(response, status, xhr) {
       if (status === 'success') {
      // Content loaded successfully
       }else if (status === 'error') {
      // Handle any loading errors
      alert('Error loading the page: ' + xhr.status + ' ' + xhr.statusText);
    }
  });
});

            // For Loading body data when clickng on dropdown links


            
        $('.collapse-item').on('click', function(e) {
        e.preventDefault(); // Prevent the default link behavior

        var page = $(this).attr('href'); // Get the URL from the href attribute

  // Use the History API to update the URL
        history.pushState(null, null, page);

  // Load the content into the #wrapper element
       $('#page-top').load(page, function(response, status, xhr) {
       if (status === 'success') {
      // Content loaded successfully
       }else if (status === 'error') {
      // Handle any loading errors
      alert('Error loading the page: ' + xhr.status + ' ' + xhr.statusText);
    }
  });
});

        }

        // Initialize the event handlers when the page loads:
        initializeEventHandlers();
    });
</script>





 





</body>

</html>