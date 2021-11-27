<?php

    if(!isset($_REQUEST['id'])){
        exit("Error: No reference found");
    }
    else{
        $ref = $_REQUEST['id'];
    }

    session_start();
    include('./includes/dbcon.php');

    if(!isset($_SESSION['username'])){
        echo "<script type='text/javascript'> document.location ='./controllers/logout.php'; </script>";
    }

    include('./controllers/itemsCon.php');

    $sql = "SELECT * FROM assets WHERE id='".$ref."'";
    $statement = $db->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

    if(sizeof($result) > 0){
        $r = $result[0];
    }
    else{
        $_SESSION['errorMessage'] = 'Item Not Found';
    }

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

  <title>Assets | Edit Asset</title>

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
                            <h1 class="m-0 text-dark">Assets</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Assets</a></li>
                            <li class="breadcrumb-item active">Edit Asset</li>
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
                            <h3 class="card-title">Edit Asset Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <?php
                            if($_SESSION['errorMessage'] ?? "" != ""){
                        ?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['errorMessage']; $_SESSION['errorMessage'] = null; ?>
                            </div>
                            <br>
                        <?php } ?>
                            <form method="post">
                                <fieldset>
                                    <div class="row">
                                        <input type="text" name="ref" value="<?php echo $r['id']; ?>" hidden>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Asset Number
                                                <input type="text" value="<?php echo $r['asset_number']; ?>" placeholder="Asset Number" name="anum" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Serial Number
                                                <input type="text" value="<?php echo $r['serial_number']; ?>" placeholder="Serial Number" name="snum" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Date Acquired
                                                <input type="date" value="<?php echo $r['date_acquired']; ?>" name="date" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Warranty Expires
                                                <input type="date" value="<?php echo $r['expiry']; ?>" name="expiry" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Make
                                                <input type="text" value="<?php echo $r['make']; ?>" placeholder="Asset Make" name="make" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Model
                                                <input type="text" value="<?php echo $r['model']; ?>" placeholder="Serial Model" name="model" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                Asset Description
                                                <textarea name="desc" value="<?php echo $r['description']; ?>" cols="30" rows="5" required placeholder="Type something here..." class="form-control">
                                                    <?php echo $r['description']; ?>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="text-center">
                                        <button type="submit" name="editItem" class="btn btn-sm btn-primary">
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
