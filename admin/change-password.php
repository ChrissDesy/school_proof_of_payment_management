<?php

    session_start();
    include('./includes/dbcon.php');

    if(!isset($_SESSION['username'])){
        echo "<script type='text/javascript'> document.location ='./controllers/logout.php'; </script>";
    }

    include('./controllers/usersCon.php');

?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

<!-- Favicon -->
<link rel="shortcut icon" href="../dist/img/AdminLTELogo.png"/>

  <title>Assets | New User</title>

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
                            <h1 class="m-0 text-dark">Settings</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Password</a></li>
                            <li class="breadcrumb-item active">Change</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container" align="center">
                    
                    <div class="card col-md-6">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-left">
                            <form method="post">
                                <?php
                                    if($_SESSION['errorMessage'] ?? "" != ""){
                                ?>
                                    <div class="text-danger text-center">
                                        <?php echo $_SESSION['errorMessage']; $_SESSION['errorMessage'] = null; ?>
                                    </div>
                                    <br>
                                <?php } 
                                    if($_SESSION['infoMessage'] ?? "" != ""){
                                ?>
                                    <div class="text-success text-center">
                                        <?php echo $_SESSION['infoMessage']; $_SESSION['infoMessage'] = null; ?>
                                    </div>
                                    <br>
                                <?php } ?>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                Old Password
                                                <input type="password" name="old" required placeholder="Old Password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                New Password
                                                <input type="password" name="new" required placeholder="New Password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                Confirm Password
                                                <input type="password" name="confirm" required placeholder="Confirm Password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="text-center">
                                        <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                                        <button type="submit" name="pwdChange" class="btn btn-sm btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </fieldset>
                            </form>
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
