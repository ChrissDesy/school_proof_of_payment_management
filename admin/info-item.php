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

    $sql = "
        SELECT 
            assets.id, date_acquired, expiry, assets.description, make, model, serial_number, asset_number, created_by, date_added, assets.status, name 
        FROM assets, types 
        WHERE assets.id = ".$ref." AND assets.type = types.id;
    ";
    $statement = $db->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

    $sql2 = "
        SELECT * FROM holders WHERE asset = ".$ref." AND status = 'active'
    ";
    $statement2 = $db->prepare($sql2);
    $statement2->execute();
    $holders = $statement2->fetchAll();

    if(sizeof($result) > 0){
        $r = $result[0];
    }
    else{
        $_SESSION['errorMessage'] = 'Item Not Found';
    }

    if(sizeof($holders) > 0){
        $h = $holders[0];
    }
    else{
        $h = 'None';
    }

    // return $holders;

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

  <title>Assets | View Asset</title>

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
                            <li class="breadcrumb-item active">View Asset</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="text-center">
                    <?php
                        if($_SESSION['errorMessage'] ?? "" != ""){
                    ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['errorMessage']; $_SESSION['errorMessage'] = null; ?>
                        </div>
                        <br>
                    <?php } ?>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <!-- Asset Info -->
                        <div class="col-md-5 col-lg-4 h-100">
                            <div class="card">
                                <div class="card-header pb-3">
                                    <h3 class="card-title">Asset Info</h3>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item">
                                                <b>Asset Type</b>
                                                <span class="float-right text-muted"><?php echo $r['name']; ?></span>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Asset Number</b>
                                                <span class="float-right text-muted"><?php echo $r['asset_number']; ?></span>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Serial Number</b>
                                                <span class="float-right text-muted"><?php echo $r['serial_number']; ?></span>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Model</b> 
                                                <span class="float-right text-muted"><?php echo $r['model']; ?></span>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Make</b>
                                                <span class="float-right text-muted"><?php echo $r['make']; ?></span>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Date Acquired</b>
                                                <span class="float-right text-muted"><?php echo $r['date_acquired']; ?></span>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Warranty Expiry Date</b>
                                                <span class="float-right text-muted"><?php echo $r['expiry']; ?></span>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Date Registered</b> 
                                                <span class="float-right text-muted"><?php echo $r['date_added']; ?></span>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Created By</b> 
                                                <span class="float-right text-muted"><?php echo $r['created_by']; ?></span>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Status</b> <span class="float-right text-muted"><?php echo $r['status']; ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-7 col-lg-8 h-100">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-8">
                                            <h4 class="card-title">Asset Holder</h4>
                                        </div>
                                        <div class="col-4 text-right">
                                            <?php if($h == 'None') { ?>
                                                <button data-toggle="modal" data-target="#assign" class="btn btn-sm btn-outline-primary">
                                                    <i class="fa fa-link"></i>&nbsp;&nbsp;Assign
                                                </button>
                                            <?php } else { ?>
                                                <button data-toggle="modal" data-target="#unassign" class="btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-unlink"></i>&nbsp;&nbsp;Un-assign
                                                </button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Holder</th>
                                                    <th>Office</th>
                                                    <th>Location</th>
                                                    <th>Date&nbsp;Assigned</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  if($h != 'None' && isset($h)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $h['holder']; ?></td>
                                                        <td><?php echo $h['office']; ?></td>
                                                        <td><?php echo $h['location']; ?></td>
                                                        <td><?php echo $h['date_assigned']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-8">
                                            <h4 class="card-title">Asset Planned Maintanances</h4>
                                        </div>
                                        <div class="col-4 text-right">
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-plus"></i>&nbsp;&nbsp;Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Done By</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php include('./includes/footer.php'); ?>

        <!-- Modals -->
        <div class="modal fade" id="assign">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Assign Asset</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="row">
                                <input type="text" name="asset" value="<?php echo $ref; ?>" hidden>
                                <div class="col-12">
                                    <div class="form-group">
                                        Assigning Person
                                        <input type="text" name="hold" placeholder="Holder Name" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        Office
                                        <input type="text" name="office" placeholder="Office" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        Location
                                        <input type="text" name="loc" placeholder="Location" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-sm btn-primary" type="submit" name="assItem" class="form-control">Assign</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="unassign">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Un-Assign Asset Holder</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div align="center">
                                <h3>Confirm to remove asset from current Holder?</h3>
                                <input type="text" class="form-control" value="<?php echo $ref; ?>" name="id" hidden>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-sm btn-danger" type="submit" name="unassItem" class="form-control">Un-Assign</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </div>
    <!-- ./wrapper -->
    

    <!-- REQUIRED SCRIPTS -->
    <?php include('./includes/javascripts.php'); ?>

    <script>
        
    </script>
    
</body>
</html>
