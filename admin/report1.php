<?php

    session_start();
    include('./includes/dbcon.php');

    if(!isset($_SESSION['username'])){
        echo "<script type='text/javascript'> document.location ='./controllers/logout.php'; </script>";
    }

    $sql = "select type, name, count(type) as count
            from assets, types
            where assets.type = types.id
            group by type, name;";
    $statement = $db->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

<!-- Favicon -->
<link rel="shortcut icon" href="../dist/img/AdminLTELogo.png"/>

  <title>Assets | Reporting</title>

  <?php include('./includes/styles.php'); ?>
  
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include('./includes/header.php'); ?>

        <!-- Main Sidebar Container -->
        <?php include('./includes/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Reports</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Assets</a></li>
                            <li class="breadcrumb-item active">Types</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container">
                    
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Asset Types Report</h3>
                                </div>
                                <div class="col-md-6 mt-2 mt-md-0 text-right">
                                    <span class="btn btn-sm btn-outline-secondary" onclick="toggleShow()">
                                        <i class="fa fa-chart-area"></i>&nbsp;|&nbsp;<i class="fa fa-table"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="tableArea" style="display: none;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Asset&nbsp;Type</th>
                                        <th>Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result as $r) {
                                        ?>
                                        <tr>
                                            <td><?php echo $r['name']; ?></td>
                                            <td><?php echo $r['count']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body" id="chartArea">
                            <div class="chart">
                                <canvas id="barChart" style="height:230px"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php include('./includes/footer.php'); ?>

    </div>
    <!-- ./wrapper -->
    

    <!-- REQUIRED SCRIPTS -->
    <?php include('./includes/javascripts.php'); ?>
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <script>
        let data, show = true;

        $(function(){
            data = <?php echo json_encode($result); ?>;

            createChart();
        });

        function toggleShow(){
            if(show){
                $('#chartArea').hide();
                $('#tableArea').show();
            }
            else{
                $('#chartArea').show();
                $('#tableArea').hide();
            }

            show = !show;
        }

        function createChart(){

            let labels = [];
            let myData = [];

            data.forEach(r => {
                labels.push(r.name);
                myData.push(r.count);
            });

            let areaChartData = {
                labels  : labels,
                datasets: [
                    {
                        label               : 'Assets by Types',
                        backgroundColor     : 'rgba(60,141,188,0.5)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : myData
                    }
                ]
            }

            let barChartCanvas = $('#barChart').get(0).getContext('2d')
            let barChartData = jQuery.extend(true, {}, areaChartData)
            barChartData.datasets[0] = areaChartData.datasets[0]

            let barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }                
            }

            let barChart = new Chart(barChartCanvas, {
                type: 'bar', 
                data: barChartData,
                options: barChartOptions
            });

        }
    </script>
    
</body>
</html>
