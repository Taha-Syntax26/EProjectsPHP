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
<!-- PHP for database -->


<?php
// for addind prodcut category form db;
$category_query_diff = "SELECT * FROM `category`";
$category_prepare_diff = $connection->prepare($category_query_diff);
$category_prepare_diff->execute();
$category_data_diff = $category_prepare_diff->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Category</title>

    <!-- Custom fonts for this template-->
    <!-- Add this line before your custom script -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <h1 style="color: rgba(31, 28, 28, 0.726);" class="h3 mb-4 font-weight-bold  text-center">Add Categories</h1>
            <hr>
            <!-- Form Start -->
            <div class="container mt-5 p-container">
                <div class="row ">
                    <div class="col-lg-7 mx-auto">
                        <div class="card mt-2 mx-auto p-4 bg-light">
                            <div class="card-body bg-light">

                                <div class="container">
                                    <form id="add" action="add_category.php" method="post">
                                        <div class="controls">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="form_name">Product Name</label>
                                                        <input id="pro_name" type="text" name="Product_Name" class="form-control" placeholder="Product Name" required="required" data-error="Username is required.">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="form_lastname">Status</label>
                                                        <select id="status_name" name="is_visible" class="form-control" data-error="Please specify your need." required>
                                                            <option value="" selected disabled>---Select---</option>
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="submit" class="btn btn-primary btn-send pt-2 btn-block" value="Add Product" name="submit">
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

            <!-- Category tabele usign loop  for show hide and delete-->
            <div class="card mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Category </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>


                             <!-- Add an ID to the tbody element -->
                             <tbody id="category-table-body">
                                  <?php include('get_category_table.php'); ?>
                             </tbody>




                        </table>
                    </div>
                </div>
            </div>
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
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>




 <script>
    $(document).ready(function () {
    $("#add").submit(function (event) {
        event.preventDefault();
        let pro_name = $('#pro_name').val();
        let pro_status = $('#status_name').val();

        // Send the data to the server using AJAX
        $.ajax({
            type: 'POST',
            url: 'categories_form.php',
            data: {
                pro_name: pro_name,
                pro_status: pro_status
            },
            success: function (response) {
                // Load the dynamically generated anchor links
                $('#collapseUtilities .collapse-inner').load('get_category_links.php');

                // Load the dynamically generated table body
                $('#category-table-body').load('get_category_table.php');

                // For Reset form after submission
                let form = document.getElementById("add");
                form.reset();
            }
        });
    });
});

 </script>










































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