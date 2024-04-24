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

// Calculate total products count
$total_products_count += $tested_products_count;

// Calculate the percentage of passed products
$pass_percentage = 0; // Default to 0
if ($total_products_count > 0) {
    $pass_percentage = ($total_pass_products / $total_products_count) * 100;
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

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!--  -->
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
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            
            </div>

            <!-- Content Row -->
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

            <!-- Content Row -->
            <!--  -->
            <div class="row">
                <!-- chart -->
                <div class="col-xl-12 col-lg-7">
                    <div class="card shadow mb-4 p-4 ">
                        <canvas id="productChart" width="400" height="120"></canvas>
                    </div>
                </div>
            </div>

            <!--  -->
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <!-- <h6 class="m-0 font-weight-bold text-primary"> <style ="color:#d51a0c;"></style>Earnings Overview</h6> -->
                            <h6 style="color:red;">Earnings Overview</h6>
                            
                        
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <!-- <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6> -->
                            <h6 style="color:red;">Revenue Sources</h6>
                           
                                
                        
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Content Column -->
                <div class="col-lg-6 mb-4">

                    <!-- Project Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 style="color:red;">Projects</h6>
                        </div>
                        <div class="card-body">
                            <h4 class="small font-weight-bold">Total Products <span class="float-right"><?php echo $total_products_count ?></span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width:100%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Tested Products <span class="float-right"><?php echo $tested_products_count ?></span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $tested_products_count ?>%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Pass Products <span class="float-right"><?php echo $total_pass_products ?></span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $total_pass_products ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Fail Products<span class="float-right"><?php echo $total_fail_products ?></span></h4>
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_fail_products ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                           
                        </div>
                    </div>

                    <!-- Color System -->
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Primary
                                    <div class="text-white-50 small">#4e73df</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Success
                                    <div class="text-white-50 small">#1cc88a</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                    Info
                                    <div class="text-white-50 small">#36b9cc</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-warning text-white shadow">
                                <div class="card-body">
                                    Warning
                                    <div class="text-white-50 small">#f6c23e</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-danger text-white shadow">
                                <div class="card-body">
                                    Danger
                                    <div class="text-white-50 small">#e74a3b</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-secondary text-white shadow">
                                <div class="card-body">
                                    Secondary
                                    <div class="text-white-50 small">#858796</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-light text-black shadow">
                                <div class="card-body">
                                    Light
                                    <div class="text-black-50 small">#f8f9fc</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-dark text-white shadow">
                                <div class="card-body">
                                    Dark
                                    <div class="text-white-50 small">#5a5c69</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 mb-4">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 style="color:red;">Illustrations</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="...">
                            </div>
                            <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                constantly updated collection of beautiful svg images that you can use
                                completely free and without attribution!</p>
                            <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                unDraw &rarr;</a>
                        </div>
                    </div>

                    <!-- Approach -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 style="color:red;">Development Approach</h6>
                        </div>
                        <div class="card-body">
                            <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                CSS bloat and poor page performance. Custom CSS classes are used to create
                                custom components and custom utility classes.</p>
                            <p class="mb-0">Before working with this theme, you should become familiar with the
                                Bootstrap framework, especially the utility classes.</p>
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
                    <a class="btn btn-primary" href="logout.php">Logout</a>

                    <!-- <input type="submit" class="btn btn-primary" href="logout.php" value="logout"> -->
                </div>
            </div>
        </div>
    </div>


    <script>
        // PHP data passed to JavaScript
        var totalProducts = <?php echo $total_products_count; ?>;
        var totalTested = <?php echo $tested_products_count; ?>;
        var totalPass = <?php echo $total_pass_products; ?>;
        var totalFail = <?php echo $total_fail_products; ?>;

        // Chart.js data
        var ctx = document.getElementById('productChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Products', 'Tested Products', 'Pass', 'Fail'],
                datasets: [{
                    label: 'Product Counts',
                    data: [totalProducts, totalTested, totalPass, totalFail],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 99, 132, 0.6)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Product Counts',
                        font: {
                            weight: 'bold',
                            size: 16
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: 'rgba(0, 0, 0, 0.7)',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        ticks: {
                            color: 'rgba(0, 0, 0, 0.7)',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    }
                }
            }
        });
    </script>
    <script>

var ctx = document.getElementById('myPieChart2').getContext('2d');
var totalProducts = <?php echo $total_products_count; ?>;
var totalPass = <?php echo $total_pass_products; ?>;
var totalFail = <?php echo $total_fail_products; ?>;

// Enhanced data structure for the pie chart
var data = {
    labels: ['Total Products', 'Pass', 'Fail'],
    datasets: [{
        data: [totalProducts, totalPass, totalFail],
        backgroundColor: [
            'rgba(54, 162, 235, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(255, 206, 86, 0.6)'
        ],
        borderColor: [
            'rgba(54, 162, 235, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(255, 206, 86, 1)'
        ],
        borderWidth: 1
    }]
};

var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: data,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    usePointStyle: true,
                    padding: 20,
                    font: {
                        size: 14
                    }
                }
            },
            tooltip: {
                enabled: true,
                mode: 'index',
                intersect: false,
                bodyFont: {
                    size: 14
                },
                backgroundColor: 'rgba(0, 0, 0, 0.8)'
            },
            title: {
                display: true,
                text: 'Product Pie Chart',
                font: {
                    weight: 'bold',
                    size: 16
                }
            }
        },
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
});

    </script>

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