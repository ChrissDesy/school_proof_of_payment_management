<?php

    session_start();
    include('./includes/dbcon.php');

    if(!isset($_SESSION['username'])){
        echo "<script type='text/javascript'> document.location ='./controllers/logout.php'; </script>";
    }

    //get employees
    // $sql = "SELECT * FROM fees";
    // $statement = $db->prepare($sql);
    // $statement->execute();
    // $result = $statement->fetchAll();

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

  <title>Payments | Student Report</title>

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
                            <li class="breadcrumb-item"><a href="#">Student</a></li>
                            <li class="breadcrumb-item active">Fees Report</li>
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
                                <div class="col-md-6"><h3 class="card-title">List of Student Payments</h3></div>
                                <div class="col-md-6" align="right">
                                    <div class="w-50">
                                        <select class="form-control">
                                            <option value="" disabled>choose...</option>
                                            <option value="2021">2021</option>
                                            <option value="2022" selected>2022</option>
                                            <option value="2023">2023</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Term 1</th>
                                            <th>Term 2</th>
                                            <th>Term 3</th>
                                            <th>Total Paid</th>
                                            <th>Owing</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
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
        

    </script>
    
</body>
</html>
