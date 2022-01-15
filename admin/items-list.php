<?php

    session_start();
    include('./includes/dbcon.php');
    include('./controllers/itemsCon.php');

    if(!isset($_SESSION['username'])){
        echo "<script type='text/javascript'> document.location ='./controllers/logout.php'; </script>";
    }

    //get
    $sql = "SELECT * FROM assets";
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
                            <h1 class="m-0 text-dark">Assets</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Assets</a></li>
                            <li class="breadcrumb-item active">All Assets</li>
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
                                <div class="col-md-6"><h3 class="card-title">All Registered Assets</h3></div>
                                <div class="col-md-6 text-right">
                                    <a href="./new-item.php" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-plus"></i>&nbsp;&nbsp;Add
                                    </a>
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
                                            <th>Serial&nbsp;Number</th>
                                            <th>Make</th>
                                            <th>Model</th>
                                            <th>Date&nbsp;Acquired</th>
                                            <th>Expiry&nbsp;Date</th>
                                            <th>Created&nbsp;By</th>
                                            <th>Date&nbsp;Added</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $r) {
                                            ?>
                                            <tr>
                                                <td><?php echo $r['asset_number']; ?></td>
                                                <td><?php echo $r['serial_number']; ?></td>
                                                <td><?php echo $r['make']; ?></td>
                                                <td><?php echo $r['model']; ?></td>
                                                <td><?php echo $r['date_acquired']; ?></td>
                                                <td><?php echo $r['expiry']; ?></td>
                                                <td><?php echo $r['created_by']; ?></td>
                                                <td><?php echo $r['date_added']; ?></td>
                                                <td><?php echo $r['status']; ?></td>
                                                <td>
                                                    <span class="text-info" title="View Description" data-target="#info" data-toggle="modal" data-myid="<?php echo $r['id']; ?>">
                                                        <i class="fa fa-list-alt"></i>
                                                    </span>&nbsp;
                                                    <a class="text-primary" title="View Asset Info" href="./info-item.php?id=<?php echo $r['id']; ?>">
                                                        <i class="fa fa-eye"></i>
                                                    </a>&nbsp;
                                                    <a class="text-warning" title="Edit Asset" href="./edit-item.php?id=<?php echo $r['id']; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </a>&nbsp;
                                                    <span class="text-danger" title="Delete Asset" data-target="#docs" data-toggle="modal" data-myid="<?php echo $r['id']; ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </span>
                                                </td>
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

    <div class="modal fade" id="docs">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Record</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div align="center">
                            <h3>Confirm Delete Record.?</h3>
                            <input type="text" class="form-control" id="myId2" name="id" style="display:none;">
                        </div>
                        <div class="text-center">
                            <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-sm btn-danger" type="submit" name="deleteItem" class="form-control">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="info">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Asset Description</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div align="center">
                            <p id="descInfo"></p>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    

    <!-- REQUIRED SCRIPTS -->
    <?php include('./includes/javascripts.php'); ?>

    <script>
        let data;

        $(function () {
            $("#example1").DataTable();

            data = <?php echo json_encode($result); ?>;
        });

        $("#docs").on('show.bs.modal', function (e) {
            
            var Id = $(e.relatedTarget).data('myid');

            // console.log(obj);
			$('#myId2').val(Id);
        });

        $("#info").on('show.bs.modal', function (e) {
            
            var Id = $(e.relatedTarget).data('myid');

            data.forEach(r => {
                if(r.id == Id){
                    $('#descInfo').html(r.description);
                }
            });
        });

    </script>
    
</body>
</html>
