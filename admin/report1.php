<?php

    $fee = $_GET['fee'] ?? '';

    session_start();
    include('./includes/dbcon.php');

    if(!isset($_SESSION['username'])){
        echo "<script type='text/javascript'> document.location ='./controllers/logout.php'; </script>";
    }

    //get employees
    $sql = "SELECT
                amount, fname, lname, f.year, f.period, total
            FROM payments AS p
            LEFT JOIN students AS s ON p.student = s.id
            INNER JOIN fees AS f ON p.fee = f.id
            WHERE p.status = 'paid'";
    $fee != '' ? $sql .= " AND p.fee = '$fee'" : $sql .= "";
    $statement = $db->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

    // get fees
    $sql2 = "SELECT * FROM fees";
    $statement2 = $db->prepare($sql2);
    $statement2->execute();
    $result2 = $statement2->fetchAll();

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

  <title>Payments | Report</title>

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
                            <li class="breadcrumb-item"><a href="#">Paid</a></li>
                            <li class="breadcrumb-item active">All Paid</li>
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
                                <div class="col-md-6"><h3 class="card-title">List of Paid Students</h3></div>
                                <div class="col-md-6 text-right">
                                    <form method="GET">
                                        <div class="row">
                                            <div class="col-md-8" align="right">
                                                <select class="form-control w-75" name="fee">
                                                    <option value="">choose period...</option>
                                                    <?php foreach ($result2 as $r) {
                                                        ?>
                                                        <tr>
                                                            <option value="<?php echo $r['id']; ?>" <?php if($r['id'] == $fee) echo 'selected' ?> ><?php echo $r['year']. ' / Term-'. $r['period']; ?></option>
                                                        </tr>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-sm btn-primary" type="submit">
                                                    Get Report
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Period</th>
                                            <th>Student</th>
                                            <th>Total Fee</th>
                                            <th>Amount Paid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $r) {
                                            ?>
                                            <tr>
                                                <td><?php echo $r['year']. ' / Term-'. $r['period']; ?></td>
                                                <td><?php echo $r['fname']. ' '. $r['lname']; ?></td>
                                                <td><?php echo 'US$'.$r['total']; ?></td>
                                                <td><?php echo 'US$'.$r['amount']; ?></td>
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

    </script>
    
</body>
</html>
