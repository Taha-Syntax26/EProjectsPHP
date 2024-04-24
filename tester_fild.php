<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<?php
require 'Connection/connection.php';
?>

<?php
// for fetching the data from `testing_forms` using name in link
$prod_id_get = $_GET['id'];
$single_product_query = "SELECT * FROM testing_forms WHERE id = :id";
$single_product_prepare = $connection->prepare($single_product_query);
$single_product_prepare->bindParam(':id', $prod_id_get);
$single_product_prepare->execute();
$products_data = $single_product_prepare->fetch(PDO::FETCH_ASSOC);

?>
<?php
// for generate product unique testing id
$testing_id = substr(str_shuffle("0123456789"), 0, 10);
?>
<?php

    $ProductUniqueId = $products_data["product_unique_id"] ;
    $ProductTesting_Id = $testing_id;
    $UploaderName = $products_data["username"] ;
    $ProductName = $products_data["product_name"] ;
    $DatE =  $products_data["date"];
 


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
            <h1 style="color: rgba(31, 28, 28, 0.726);" class="h3 mb-4 font-weight-bold  text-center">Testing</h1>
            <hr>

            <!-- Form Start -->
            <div class="container mt-5 p-container">
                <div class="row ">
                    <div class="col-lg-7 mx-auto">
                        <div class="card mt-2 mx-auto p-4 bg-light">
                            <div class="card-body bg-light">

                                <div class="container">
                                    <form id="testerForm" role="form" method="post">



                                        <div class="controls">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="form_name">Product ID</label>
                                                        <input id="form_name" type="text" value="<?php echo $products_data["product_unique_id"] ?>" name="product_unique_id" class="form-control" readonly>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="form_name">Testing ID</label>
                                                        <input id="form_name" value="<?php echo $testing_id ?>" type="text" name="product_testing_id" class="form-control" placeholder="Your Name" required="required" data-error="Username is required." readonly>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="form_name">Uploader Name</label>
                                                        <input id="form_name" type="text" value="<?php echo $products_data["username"] ?>" name="uploader_name" class="form-control" placeholder="Your Name" required="required" data-error="Username is required." readonly>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="form_name">Product</label>
                                                        <input id="form_name" type="text" value="<?php echo $products_data["product_name"] ?>" name="product_name" class="form-control" placeholder="Your Name" required="required" data-error="Username is required." readonly>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="form_name">Date</label>
                                                        <input id="form_name" type="text" value="<?php echo $products_data["date"] ?>" name="date" class="form-control" placeholder="Your Name" required="required" data-error="Username is required." readonly>
                                                    </div>

                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="form_need">Testing Type</label>
                                                        <select id="testing_type" name="testing_type" class="form-control" required="required" data-error="Please specify your need.">
                                                            <option value="" selected disabled>--Select Testing Type--
                                                            </option>
                                                            <option>Voltage Test</option>
                                                            <option>Capacity Test</option>
                                                            <option selected>
                                                                <?php echo $products_data["testing_type"] ?>
                                                            </option>
                                                            <option>Time-Current Test</option>
                                                            <option>Insulation Test</option>
                                                            <option>Other</option>
                                                        </select>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="form_email"> Rating</label>
                                                    <input id="rating" type="number" min="1" max="5" name="rating" class="form-control" placeholder="Rate out of 5" required="required" data-error="Rating is required.">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="form_need">Result</label>
                                                    <select id="result" name="result" class="form-control" required="required" data-error="Please specify your need.">
                                                        <option value="" selected disabled>--Select the Result --
                                                        </option>
                                                        <option>Pass</option>
                                                        <option>Fail</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="form_message">Remarks</label>
                                                    <textarea id="remarks" name="remarks" class="form-control" placeholder="Write your Remarks here." rows="1" data-error="Please, leave us a message."></textarea>
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="form_message">Description</label>
                                                    <textarea id="desc" name="desc" class="form-control" placeholder="Write your message here." rows="4" required="required" data-error="Please, leave us a message."></textarea>
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <input type="submit" class="btn btn-primary btn-send  pt-2 btn-block" value="Send For Testing" name="submit">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.8 -->

                </div>
                <!-- /.row-->

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
    $("#testerForm").submit(function(event) {
        event.preventDefault();

        let product_unique_id = "<?php echo $products_data['product_unique_id'] ?>";
        let product_testing_id = "<?php echo $testing_id ?>";
        let uploader_name = "<?php echo $products_data['username'] ?>";
        let product_name = "<?php echo $products_data['product_name'] ?>";
        let date = "<?php echo $products_data['date'] ?>";
        let testing_type = $('#testing_type').val(); // Assuming the select element has the id 'form_need'
        let rating = $('#rating').val(); // Assuming the input element has the id 'form_email'
        let result = $('#result').val(); // Assuming the select element for result has the id 'form_need_result'
        let remarks = $('#remarks').val(); // Assuming the textarea for remarks has the id 'form_message'
        let desc = $('#desc').val(); // Assuming the textarea for description has the id 'form_message_desc'

        $.ajax({
            type: 'POST',
            url: 'tester_fild_form.php',
            data: {
                Product_unique_id: product_unique_id,
                Product_testing_id: product_testing_id,
                Uploader_name: uploader_name,
                Product_name: product_name,
                Date: date,
                Testing_type: testing_type,
                Rating: rating,
                Result: result,
                Remarks: remarks,
                Desc: desc,
            },
            success: function(response) {
                // Handle the server response here (if needed)
                "<?php $delete_product_query = "DELETE FROM testing_forms WHERE id = :id";
                 $delete_product_prepare = $connection->prepare($delete_product_query);
                 $delete_product_prepare->bindParam(':id', $prod_id_get);
                 $delete_product_prepare->execute(); ?>"
                 let form = document.getElementById("testerForm");
                 form.reset();
                 
            }
        });
    });
});
</script>


        
    <!-- PHP for Sending to database -->







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


          // For Loading body data when clickng on Tested links

        $('.test-now-button').on('click', function() {
            var category = $(this).data('category'); // Get the category name
            var page = 'tester_fild.php?id=' + category;

            // Load the content into the #page-top element
            $('#page-top').load(page, function(response, status, xhr) {
                if (status === 'success') {
                    // Content loaded successfully
                    initializeEventHandlers(); // Reinitialize event handlers
                } else if (status === 'error') {
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