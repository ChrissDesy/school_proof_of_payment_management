<?php 

//   session_start();
//   include('./admin/includes/dbcon.php');

  $mode = 'reset';

//   if($_SESSION['username'] ?? '' != ''){
//     echo "<script type='text/javascript'> document.location ='./admin/index.php'; </script>";
//   }

//   include('./admin/controllers/userLogin.php');

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Payments | Forgot Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>PAYMENTS</b>PRO</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Forgot Password</p>
        <?php
            if($_SESSION['errorMessage'] ?? "" != ""){
        ?>
          <div class="text-danger text-center">
              <?php echo $_SESSION['errorMessage']; $_SESSION['errorMessage'] = null; ?>
          </div>
          <br>
        <?php } ?>


        <!-- Reset Logic -->

        <?php if($mode == "reset"){ ?>
            <div>
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" required name="username" class="form-control" placeholder="Username">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <!-- <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                            Remember Me
                        </label>
                        </div> -->
                        </div>
                        <!-- /.col -->
                        <div class="col-8">
                            <button type="submit" name="reset" class="btn btn-sm btn-primary btn-block btn-flat">Reset
                                Password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        <?php } else { ?>
            <div>
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="password" required name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" required name="password2" class="form-control" placeholder="Confirm Password">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <!-- <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div> -->
                        </div>
                        <!-- /.col -->
                        <div class="col-8">
                            <button type="submit" name="change" class="btn btn-sm btn-primary btn-block btn-flat">Change Password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        <?php } ?>

      <p class="mb-1 mt-4">
        <!-- <a href="#">I forgot my password</a> -->
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
