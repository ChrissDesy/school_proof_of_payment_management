<?php

    session_start();
    //include('./includes/dbcon.php');

    if(!isset($_SESSION['username'])){
        echo "<script type='text/javascript'> document.location ='./controllers/logout.php'; </script>";
    }

    // include('./controllers/homeCon.php');

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

  <title>Payments | Home</title>

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
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-inbox"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">New Payments</span>
                                <span class="info-box-number">
                                    <?php echo 10; ?>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Verified</span>
                                <span class="info-box-number"><?php echo 7; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-calendar-times"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Denied</span>
                                <span class="info-box-number"><?php echo 9; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-graduate"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Students</span>
                                <span class="info-box-number"><?php echo 20; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-md-12">
                            <!-- TABLE: LATEST ORDERS -->
                            <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Latest Payments</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Student</th>
                                                <th>Registration</th>
                                                <th>Amount</th>
                                                <th>Date&nbsp;Paid</th>
                                                <th>Term - Year</th>
                                                <th>Method</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo 'Chriss Desy' ?></td>
                                                <td><?php echo 'A1234' ?></td>
                                                <td><?php echo 'USD$100' ?></td>
                                                <td><?php echo '2022-07-09' ?></td>
                                                <td><?php echo '2 - 2022' ?></td>
                                                <td><?php echo 'ECOCASH' ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <!-- <a href="./new-item.php" class="btn btn-sm btn-outline-info float-left">
                                    <i class="fas fa-plus mr-2"></i> View New
                                </a> -->
                                <a href="./new-item.php" class="btn btn-sm btn-outline-secondary float-right">
                                    <i class="fas fa-list-ul mr-2"></i> View All
                                </a>
                            </div>
                            <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
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
    
</body>
</html>
