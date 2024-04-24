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
// Array of table names
$selected_id = $_GET["id"];

$selected_query = "SELECT * FROM `tested_product` WHERE `product_id` = :id";

$selected_prepare = $connection->prepare($selected_query);
$selected_prepare->bindValue(':id', $selected_id, PDO::PARAM_INT);
$selected_prepare->execute();

$fetch_data = $selected_prepare->fetch(PDO::FETCH_ASSOC);

$productUniqueId =$fetch_data['product_unique_id'] ;
$product_name =$fetch_data['product_name'] ;
$capitalizedProductName = ucfirst($product_name);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Repoerts</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
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
            <!-- <h1 class="h3 mb-4 text-gray-800 text-center font-weight-bold">PRODUCT REPORT</h1> -->

            <!-- Begin content -->

            <div class="container mt-5" id="htmlContent">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h3 class="text-center mb-0 font-weight-bold">Product Report</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bold">Product Name:</h5>
                                        <p><?= $fetch_data['product_name'] ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bold">Product ID:</h5>
                                        <p><?= $fetch_data['product_unique_id'] ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bold">Product Testing ID:</h5>
                                        <p><?= $fetch_data['product_testing_id'] ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bold">Date:</h5>
                                        <p><?= $fetch_data['prod_date'] ?></p>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <h5 class="font-weight-bold">Username:</h5>
                                        <p><?= $fetch_data['uploader_name'] ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bold">Testing Type:</h5>
                                        <p><?= $fetch_data['testing_type'] ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bold">Remarks:</h5>
                                        <p><?= $fetch_data['remarks'] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="font-weight-bold">Description:</h5>
                                        <p><?= $fetch_data['description'] ?></p>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary" id="generatePDF"> <i class="fas fa-download"></i> Download Report</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>


    <!-- ___Ajax Work___ -->

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
                        } else if (status === 'error') {
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


        var doc = new jsPDF();
        var specialElementHandlers = {
            '#editor': function(element, renderer) {
                return true;
            }
        };

        //margins.left, // x coord   margins.top, { // y coord
        $('#generatePDF').click(function() {
            doc.fromHTML($('#htmlContent').html(), 15, 15, {
                'width': 700,
                'elementHandlers': specialElementHandlers
            });
            var filename = <?php echo json_encode($capitalizedProductName); ?> +'-Report-ID-Num-' + <?php echo json_encode($productUniqueId); ?> + '.pdf';
            
            doc.save(filename);
        });
    </script>
















</body>

</html>