<?php

    session_start();
    include('./includes/dbcon.php');

    if(!isset($_SESSION['username'])){
        echo "<script type='text/javascript'> document.location ='./controllers/logout.php'; </script>";
    }

    include('./controllers/usersCon.php');

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

  <title>Payments | New User</title>

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
                            <h1 class="m-0 text-dark">Users</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Users</a></li>
                            <li class="breadcrumb-item active">New User</li>
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
                            <h3 class="card-title">Create New User</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="post">
                                <fieldset>
                                    <div class="row">                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Firstname
                                                <input type="text" name="fname" required placeholder="Firstname" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Lastname
                                                <input type="text" name="lname" required placeholder="Lastname" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Employee Id
                                                <input type="text" name="natid" required placeholder="Employee Id" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Email
                                                <input type="email" name="email" required placeholder="Email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Phone Number
                                                <input type="text" name="phone" required placeholder="Phone Number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Date of Birth
                                                <input type="date" name="dat" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Gender
                                                <select name="gender" required class="form-control">
                                                    <option value="" selected disabled>choose...</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Male">Male</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Username
                                                <input type="text" name="uname" required placeholder="Username" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                User Role
                                                <select name="role" required class="form-control">
                                                    <option value="" selected disabled>choose...</option>
                                                    <option value="Bursar">Bursar</option>
                                                    <option value="Head">Headmaster</option>
                                                    <option value="Admin">System Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Password
                                                <input type="password" name="pwd" id="pass1" required placeholder="Password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="text-center">
                                        <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                                        <button type="submit" name="addRec" class="btn btn-sm btn-primary">
                                            Save
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
