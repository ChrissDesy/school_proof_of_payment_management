<?php

    session_start();
    include('./includes/dbcon.php');
    include('./controllers/paymentsCon.php');

    if(!isset($_SESSION['username'])){
        echo "<script type='text/javascript'> document.location ='./controllers/logout.php'; </script>";
    }

    //get employees
    $sql = "SELECT
            t.id, t.date, t.amount, s.fname, s.lname, f.year, f.period
            FROM transactions AS t
            LEFT JOIN students AS s ON t.student = s.id
            INNER JOIN fees AS f ON t.fee = f.id";
    $statement = $db->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

    $sql1 = "SELECT * FROM students";
    $statement1 = $db->prepare($sql1);
    $statement1->execute();
    $result1 = $statement1->fetchAll();

    $sql2 = "SELECT * FROM fees";
    $statement2 = $db->prepare($sql2);
    $statement2->execute();
    $result2 = $statement2->fetchAll();

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

  <title>Payments | Payments</title>

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
                            <h1 class="m-0 text-dark">Payments</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Payments</a></li>
                            <li class="breadcrumb-item active">All Payments</li>
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
                                <div class="col-md-6"><h3 class="card-title">List of New Payments</h3></div>
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
                                            <th>Date</th>
                                            <th>Student</th>
                                            <th>Amount</th>
                                            <th>Period</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $r) {
                                            ?>
                                            <tr>
                                                <td><?php echo $r['id']; ?></td>
                                                <td><?php echo $r['date']; ?></td>
                                                <td><?php echo $r['fname']. ' '. $r['lname']; ?></td>
                                                <td><?php echo 'US$'.$r['amount']; ?></td>
                                                <td><?php echo $r['year']. ' / Term-'. $r['period']; ?></td>
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
                    <h4 class="modal-title">Add New Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    Student
                                    <select name="student" id="myStud" required class="form-control" onchange="verifyStud()">
                                        <option value="" selected disabled>choose...</option>
                                        <?php foreach ($result1 as $r) {
                                            ?>
                                            <tr>
                                                <option value="<?php echo $r['id']; ?>"><?php echo $r['fname']. ' '. $r['lname']; ?></option>
                                            </tr>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    Fees &nbsp;&nbsp; <em class="text-danger text-xs" id="owingErr"></em>&nbsp; <em class="text-success text-xs" id="paidErr"></em>
                                    <select name="fee" id="myPeriod" required class="form-control" onchange="loadDetails()">
                                        <option value="" selected disabled>choose...</option>
                                        <?php foreach ($result2 as $r) {
                                            ?>
                                            <tr>
                                                <option value="<?php echo $r['id']; ?>"><?php echo $r['year']. ' / Term-'. $r['period']; ?></option>
                                            </tr>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    Levy
                                    <input type="text" id="myLevy" readonly placeholder="Levy" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    Tuition
                                    <input type="text" id="myTuition" readonly placeholder="Tuition" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    Minimum Payable
                                    <input type="text" id="minimum" readonly placeholder="Minimum" class="form-control">
                                </div>
                            </div>                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    Amount Paid &nbsp;&nbsp; <em class="text-danger text-xs" id="amtErr"></em>
                                    <input type="text" name="amount" id="myAmt" required placeholder="Amount" class="form-control" onkeyup="checkAmt()">
                                    <input type="text" name="status" id="myStat" hidden>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="text-center">
                            <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-sm btn-primary" id="btnSubmit" type="submit" name="addPayment" class="form-control">Add</button>
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
                                    <input type="text" name="levy" id="elevy" required placeholder="Levy" class="form-control" onkeyup="calcTotal('elevy', 'etuition', 'etotal')">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    Tuition
                                    <input type="text" name="tuition" id="etuition" required placeholder="Tuition" class="form-control" onkeyup="calcTotal('elevy', 'etuition', 'etotal')">
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
                                    <input type="text" name="minimum" id="emin" required placeholder="Minimum" class="form-control">
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
        let fees, min, tot, paid = 0;

        $(function () {
            $("#example1").DataTable();

            fees = <?php echo json_encode($result2); ?>;

            // console.log(data);
        });

        function loadDetails(){
            let Id = $('#myPeriod').val();

            if(!Id) return false;

            // console.log(obj);
            let info;
            fees.forEach(r => {
                if(r.id == Id){
                    info = r;
                }
            });

            $('#myLevy').val(info.levy);
            $('#myTuition').val(info.tuition);
            $('#minimum').val(info.minimum);

            min = info.minimum;
            tot = info.total;

            verifyStud();
        }

        function verifyStud(){
            let stud = $('#myStud').val();
            let fee = $('#myPeriod').val();

            if(stud && fee){
                // console.log(stud, fee);
                $.ajax({
                    url: './controllers/verifyStudentPayment.php',
                    method: 'POST',
                    data: {student: stud, fee: fee},
                    success: function(resp){
                        // console.log(JSON.parse(resp));
                        let data = JSON.parse(resp);

                        if(data.length == 0){
                            $('#paidErr').html('');
                            $('#owingErr').html('');
                            $('#btnSubmit').attr('disabled', false);
                            paid = 0;
                            return false;
                        }

                        let info = data[0];

                        if(info.status == 'owing'){
                            let bal = Number(info.total) - Number(info.amount);
                            paid = info.amount;
                            $('#owingErr').html('Student owing ' + bal +' for this period.');
                            $('#paidErr').html('');
                            $('#btnSubmit').attr('disabled', false);
                        }
                        else if(info.status == 'paid'){
                            $('#owingErr').html('');
                            $('#paidErr').html('Student paid in full for period. ('+info.date_modified+')');
                            $('#btnSubmit').attr('disabled', true);
                            paid = 0;
                        }
                        else{
                            $('#paidErr').html('');
                            $('#owingErr').html('');
                            $('#btnSubmit').attr('disabled', false);
                            paid = 0;
                        }
                    },
                    error: function(err){
                        console.log(err.responseText);
                    }
                });
            }
        }

        function checkAmt(){
            let amt = $('#myAmt').val();
            // console.log(Number(amt) + paid);
            if(Number(amt) + Number(paid) < Number(min)){
                console.log(amt, min, paid);
                $('#amtErr').html('Amount Less than Minimum');
                $('#btnSubmit').attr('disabled', true);
            }
            else if(Number(amt) + Number(paid) > Number(tot)){
                console.log(amt, tot, paid);
                $('#amtErr').html('Amount Greater than Total');
                $('#btnSubmit').attr('disabled', true);
            }
            else{
                console.log(min, amt, tot, paid);
                $('#amtErr').html('');
                $('#btnSubmit').attr('disabled', false);
                
                (Number(amt) + Number(paid) == Number(tot)) ? $('#myStat').val('paid') : $('#myStat').val('owing');
            }
        }

    </script>
    
</body>
</html>
