<?php

    session_start();
    include('./includes/dbcon.php');
    include('./controllers/itemsCon.php');

    if(!isset($_SESSION['username'])){
        echo "<script type='text/javascript'> document.location ='./controllers/logout.php'; </script>";
    }

    //get
    $sql = "select m.status, m.done_by, m.date, date_acquired, make, model, asset_number, t.name as type
            from maintanance as m, assets as a, types as t
            where m.asset = a.id and a.type = t.id
            order by m.date desc";
    $statement = $db->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

    // echo $result;
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

  <title>Assets | Home</title>

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
                            <h1 class="m-0 text-dark">Reports</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Assets</a></li>
                            <li class="breadcrumb-item active">Maintanance</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6"><h3 class="card-title">Assets Maintanance Report</h3></div>
                                <div class="col-md-6 text-right">
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Asset&nbsp;Number</th>
                                            <th>Make</th>
                                            <th>Model</th>
                                            <th>Type</th>
                                            <th>Date&nbsp;Acquired</th>
                                            <th>Status</th>
                                            <th>Done&nbsp;By</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $r) {
                                            ?>
                                            <tr>
                                                <td><?php echo $r['asset_number']; ?></td>
                                                <td><?php echo $r['make']; ?></td>
                                                <td><?php echo $r['model']; ?></td>
                                                <td><?php echo $r['type']; ?></td>
                                                <td><?php echo $r['date_acquired']; ?></td>
                                                <td>
                                                    <?php 
                                                        if($r['status'] == 'Healthy'){
                                                            ?>
                                                                <span class="badge badge-success">
                                                                    healthy
                                                                </span>
                                                            <?php
                                                        }
                                                        elseif ($r['status'] == 'Good') {
                                                            ?>
                                                                <span class="badge badge-primary">
                                                                    good
                                                                </span>
                                                            <?php
                                                        }
                                                        elseif ($r['status'] == 'Issues') {
                                                            ?>
                                                                <span class="badge badge-warning">
                                                                    issues
                                                                </span>
                                                            <?php
                                                        }
                                                        elseif ($r['status'] == 'Dispose') {
                                                            ?>
                                                                <span class="badge badge-danger">
                                                                    dispose
                                                                </span>
                                                            <?php
                                                        }
                                                        else{
                                                            echo $r['status'];
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $r['done_by']; ?></td>
                                                <td><?php echo $r['date']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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

    <script>

        $(function () {
            $("#example1").DataTable();
        });

    </script>
    
</body>
</html>
