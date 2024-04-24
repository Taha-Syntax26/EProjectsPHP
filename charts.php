<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit; 
}
require 'Connection/connection.php';
$category_query = "SELECT * FROM `category`";
$category_prepare = $connection->prepare($category_query);
$category_prepare->execute();
$category_data = $category_prepare->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Charts</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body id="page-top">
    <div id="wrapper">
        <?php require 'header/navbar.php'; ?>

        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Charts</h1>
            <p class="mb-4">Documentation for the ApexCharts library can be found <a href="https://apexcharts.com/docs/" target="_blank">here</a>.</p>

            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                        </div>
                        <div class="card-body">
                            <div id="areaChart"></div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                        </div>
                        <div class="card-body">
                            <div id="barChart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
                        </div>
                        <div class="card-body">
                            <div id="donutChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'header/footer.php'; ?>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <script>
    new ApexCharts(document.querySelector("#areaChart"), {
        series: [{ name: 'Series 1', data: [31, 40, 28, 51, 42, 109, 100] }],
        chart: { height: 350, type: 'area' },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth' },
        xaxis: { type: 'datetime', categories: ['2019-09-19T00:00:00', '2019-09-19T01:30:00', '2019-09-19T02:30:00', '2019-09-19T03:30:00', '2019-09-19T04:30:00', '2019-09-19T05:30:00', '2019-09-19T06:30:00'] },
        tooltip: { x: { format: 'dd/MM/yy HH:mm' } },
    }).render();

    new ApexCharts(document.querySelector("#barChart"), {
        series: [{ name: 'sales', data: [440, 505, 414, 671, 227, 413, 201] }],
        chart: { type: 'bar', height: 350 },
        plotOptions: { bar: { horizontal: false, columnWidth: '55%', endingShape: 'rounded' } },
        dataLabels: { enabled: false },
        stroke: { show: true, width: 2, colors: ['transparent'] },
        xaxis: { categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'] },
    }).render();

    new ApexCharts(document.querySelector("#donutChart"), {
        series: [44, 55, 41, 17, 15],
        chart: { type: 'donut' },
        responsive: [{ breakpoint: 480, options: { chart: { width: 200 }, legend: { position: 'bottom' } } }]
    }).render();
    </script>
</body>
</html>
