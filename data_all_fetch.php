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

// for count total product count number
$total_count_Query = "SELECT COUNT(*) AS total_products FROM testing_forms";
$total_count_prepare = $connection->prepare($total_count_Query);
$total_count_prepare->execute();
$total_count_Data = $total_count_prepare->fetch(PDO::FETCH_ASSOC);
$total_products_count = $total_count_Data['total_products'];

// for count tested product count number
$tested_count_Query = "SELECT COUNT(*) AS tested_product FROM tested_product";
$tested_count_prepare = $connection->prepare($tested_count_Query);
$tested_count_prepare->execute();
$tested_count_Data = $tested_count_prepare->fetch(PDO::FETCH_ASSOC);
$tested_products_count = $tested_count_Data['tested_product'];

// for count category number
$category_count_Query = "SELECT COUNT(*) AS category FROM category";
$category_count_prepare = $connection->prepare($category_count_Query);
$category_count_prepare->execute();
$tested_count_Data_query = $category_count_prepare->fetch(PDO::FETCH_ASSOC);
$category_count = $tested_count_Data_query['category'];

// for count passing product count number
$tested_pass_Query = "SELECT COUNT(*) AS total_pass_products FROM tested_product WHERE result = 'pass'";
$tested_pass_prepare = $connection->prepare($tested_pass_Query);
$tested_pass_prepare->execute();
$tested_pass_Data = $tested_pass_prepare->fetch(PDO::FETCH_ASSOC);
$total_pass_products = $tested_pass_Data['total_pass_products'];
// for count failed product count number
$tested_fail_Query = "SELECT COUNT(*) AS total_fail_products FROM tested_product WHERE result = 'fail'";
$tested_fail_prepare = $connection->prepare($tested_fail_Query);
$tested_fail_prepare->execute();
$tested_fail_Data = $tested_fail_prepare->fetch(PDO::FETCH_ASSOC);
$total_fail_products = $tested_fail_Data['total_fail_products'];

$total_products_count += $tested_products_count;

// for passing product progress bar
$total_products = $tested_products_count;
// Calculate the percentage of passed products
$pass_percentage = 0; // Default to 0
if ($total_products > 0) {
    $pass_percentage = ($total_pass_products / $total_products) * 100;
}

?>
<?php
// Array of table names
$fetch_query = "SELECT * FROM `tested_product` ";
$fetch_prepare = $connection->prepare($fetch_query);
$fetch_prepare->execute();
$fetch_data = $fetch_prepare->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Navbar Start -->

        <?php require 'header/navbar.php' ?>

        <!-- Navbar End -->

        <!-- Begin Page Content -->
        <div class="container-fluid">


            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="row">
    <!-- Total Products Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <canvas id="totalProductsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Tested Products Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <canvas id="testedProductsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Pass Products Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <canvas id="passProductsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Fail Products Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <canvas id="failProductsChart"></canvas>
            </div>
        </div>
    </div>
</div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Result </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Unique Id</th>
                                    <th>Product Testing Id</th>
                                    <th>Test Type</th>
                                    <th>Date</th>
                                    <th>Uploaded By</th>
                                    <th>Result</th>
                                    <th>Report</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Unique Id</th>
                                    <th>Product Testing Id</th>
                                    <th>Test Type</th>
                                    <th>Date</th>
                                    <th>Uploaded By</th>
                                    <th>Result</th>
                                    <th>Report</th><
                                </tr>
                            </tfoot>
                            <tbody>
                                <!-- Now you can loop through $data_fetch_array to generate your table -->
                                <?php foreach ($fetch_data as $data) { ?>
                                    <tr>
                                        <td><?= $data['product_name'] ?></td>
                                        <td><?= $data['product_unique_id'] ?></td>
                                        <td><?= $data['product_testing_id'] ?></td>
                                        <td><?= $data['testing_type'] ?></td>
                                        <td><?= $data['prod_date'] ?></td>
                                        <td><?= $data['uploader_name'] ?></td>
                                        <td><?= $data['result'] ?></td>
                                        <td>
                                        <a href="reports.php?id=<?= $data['product_id'] ?>" class="btn btn-primary btn-sm d-sm-inline-block d-block">
                                  <i class="fas fa-download"></i> Generate
                                    </a>

                
                                        </td>
                                    </tr>
                                <?php } ?>
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>











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
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Chart for Total Products
    new Chart(document.getElementById('totalProductsChart'), {
        type: 'doughnut',
        data: {
            labels: ['Total Products'],
            datasets: [{
                data: [<?php echo $total_products_count; ?>, 100 - <?php echo $total_products_count; ?>],
                backgroundColor: ['#4e73df', '#f8f9fc'],
                hoverBorderColor: "rgba(234, 236, 244, 1)"
            }]
        },
        options: chartOptions('Total Products')
    });

    // Chart for Tested Products
    new Chart(document.getElementById('testedProductsChart'), {
        type: 'doughnut',
        data: {
            labels: ['Tested Products'],
            datasets: [{
                data: [<?php echo $tested_products_count; ?>, 100 - <?php echo $tested_products_count; ?>],
                backgroundColor: ['#1cc88a', '#f8f9fc'],
                hoverBorderColor: "rgba(234, 236, 244, 1)"
            }]
        },
        options: chartOptions('Tested Products')
    });

    // Chart for Pass Products
    new Chart(document.getElementById('passProductsChart'), {
        type: 'bar',
        data: {
            labels: ['Pass'],
            datasets: [{
                label: 'Pass',
                data: [<?php echo $total_pass_products; ?>],
                backgroundColor: ['#36b9cc']
            }]
        },
        options: {
            scales: {
                yAxes: [{ ticks: { beginAtZero: true } }]
            },
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Pass Rate'
            }
        }
    });

    // Chart for Fail Products
    new Chart(document.getElementById('failProductsChart'), {
        type: 'bar',
        data: {
            labels: ['Fail'],
            datasets: [{
                label: 'Fail',
                data: [<?php echo $total_fail_products; ?>],
                backgroundColor: ['#f6c23e']
            }]
        },
        options: {
            scales: {
                yAxes: [{ ticks: { beginAtZero: true } }]
            },
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Fail Rate'
            }
        }
    });
});

function chartOptions(title) {
    return {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10
        },
        cutoutPercentage: 80,
        title: {
            display: true,
            text: title
        }
    };
}








</script>




</body>

</html>