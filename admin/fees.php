<?php

    session_start();
    include('./includes/dbcon.php');
    include('./controllers/feesCon.php');

    if(!isset($_SESSION['username'])){
        echo "<script type='text/javascript'> document.location ='./controllers/logout.php'; </script>";
    }

    //get employees
    $sql = "SELECT * FROM fees";
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

  <title>Payments | Fees</title>

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
                            <h1 class="m-0 text-dark">Settings</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Fees</a></li>
                            <li class="breadcrumb-item active">All Fees</li>
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
                                <div class="col-md-6"><h3 class="card-title">List of Fees</h3></div>
                                <div class="col-md-6 text-right">
                                    <button data-target="#add" data-toggle="modal" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-plus"></i>&nbsp;&nbsp;Add
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Reference</th>
                                            <th>Year/Period</th>
                                            <th>Levy</th>
                                            <th>Tuition</th>
                                            <th>Total</th>
                                            <th>Minimum</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $r) {
                                            ?>
                                            <tr>
                                                <td><?php echo $r['id']; ?></td>
                                                <td><?php echo $r['year'] . '/ Term-' . $r['period']; ?></td>
                                                <td><?php echo 'US$'.$r['levy']; ?></td>
                                                <td><?php echo 'US$'.$r['tuition']; ?></td>
                                                <td><?php echo 'US$'.$r['total']; ?></td>
                                                <td><?php echo 'US$'.$r['minimum']; ?></td>
                                                <td>
                                                    <span class="text-warning mr-3" data-target="#edit" data-toggle="modal" data-myid="<?php echo $r['id']; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                    <span class="text-danger" data-target="#delete" data-toggle="modal" data-myid="<?php echo $r['id']; ?>">
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

    <div class="modal fade" id="add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Record</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    Year
                                    <select name="year" required class="form-control">
                                        <option value="" disabled>choose...</option>
                                        <option value="2021">2021</option>
                                        <option value="2022" selected>2022</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    Term
                                    <select name="term" required class="form-control">
                                        <option value="" selected disabled>choose...</option>
                                        <option value="1">Term 1</option>
                                        <option value="2">Term 2</option>
                                        <option value="3">Term 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    Levy
                                    <input type="number" name="levy" id="myLevy" required placeholder="Levy" class="form-control" onkeyup="calcTotal('myLevy', 'myTuition', 'myTot')">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    Tuition
                                    <input type="number" name="tuition" id="myTuition" required placeholder="Tuition" class="form-control" onkeyup="calcTotal('myLevy', 'myTuition', 'myTot')">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    Total
                                    <input type="text" name="total" id="myTot" required placeholder="Total" readonly class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    Minimum Payable
                                    <input type="number" name="minimum" required placeholder="Minimum" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="text-center">
                            <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-sm btn-primary" type="submit" name="addFee" class="form-control">Add</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Record</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="row">
                            <div hidden>
                                <input type="text" name="id" id="eId">
                            </div>                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    Levy
                                    <input type="number" name="levy" id="elevy" required placeholder="Levy" class="form-control" onkeyup="calcTotal('elevy', 'etuition', 'etotal')">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    Tuition
                                    <input type="number" name="tuition" id="etuition" required placeholder="Tuition" class="form-control" onkeyup="calcTotal('elevy', 'etuition', 'etotal')">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    Total
                                    <input type="text" name="total" id="etotal" required placeholder="Total" readonly class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    Minimum Payable
                                    <input type="number" name="minimum" id="emin" required placeholder="Minimum" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="text-center">
                            <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-sm btn-primary" type="submit" name="editFee" class="form-control">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="delete">
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
                            <button class="btn btn-sm btn-danger" type="submit" name="deleteFee" class="form-control">Delete</button>
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

            // console.log(data);
        });

        $("#edit").on('show.bs.modal', function (e) {
            
            var Id = $(e.relatedTarget).data('myid');

            // console.log(obj);
			$('#eId').val(Id);
            let info;
            data.forEach(r => {
                if(r.id == Id){
                    info = r;
                }
            });

            $('#elevy').val(info.levy);
            $('#etuition').val(info.tuition);
            $('#etotal').val(info.total);
            $('#emin').val(info.minimum);

        });

        $("#delete").on('show.bs.modal', function (e) {
            
            var Id = $(e.relatedTarget).data('myid');

            // console.log(obj);
			$('#myId2').val(Id);
        });

        function calcTotal(val1, val2, answer){
            let a = Number($('#'+val1).val() ?? 0);
            let b = Number($('#'+val2).val() ?? 0);

            $('#'+answer).val(a + b);
        }

    </script>
    
</body>
</html>
