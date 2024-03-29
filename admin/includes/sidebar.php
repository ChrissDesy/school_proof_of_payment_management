<?php

    $showDrop = ''; // change between assets, reports, users, settings

    $url = $_SERVER['PHP_SELF'];
    $uType = $_SESSION['utype'];

    if(
        strpos($url, '/pop-mgnt/admin/new-payment.php') !== false
    ){
        $showDrop = 'payments';
    }
    else if(
        strpos($url, '/pop-mgnt/admin/new-student.php') !== false ||
        strpos($url, '/pop-mgnt/admin/edit-student.php') !== false ||
        strpos($url, '/pop-mgnt/admin/students-list.php') !== false
    ){
        $showDrop = 'students';
    }
    else if(
        strpos($url, '/pop-mgnt/admin/new-user.php') !== false ||
        strpos($url, '/pop-mgnt/admin/edit-user.php') !== false ||
        strpos($url, '/pop-mgnt/admin/users-list.php') !== false
    ){
        $showDrop = 'users';
    }
    else if(
        strpos($url, '/pop-mgnt/admin/report1.php') !== false ||
        strpos($url, '/pop-mgnt/admin/report2.php') !== false ||
        strpos($url, '/pop-mgnt/admin/report3.php') !== false ||
        strpos($url, '/pop-mgnt/admin/report5.php') !== false 
    ){
        $showDrop = 'reports';
    }
    else if(
        strpos($url, '/pop-mgnt/admin/change-password.php') !== false ||
        strpos($url, '/pop-mgnt/admin/fees.php') !== false
    ){
        $showDrop = 'settings';
    }
    else{
        $showDrop = '';
    }

    if($_SESSION['utype'] == 'Bursar'){
        $pic = '../dist/img/bursar.jpeg';
    }
    else{
        $pic = '../dist/img/logo.jpg';
    }

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="Admin Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">PaymentsPRO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo $pic; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['username'] ?? 'User'; ?></a>
            </div>
        </div>

        <?php if($uType == 'Admin') { ?>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="index.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/index.php') echo 'active'; ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview <?php if($showDrop == 'payments') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link <?php if($showDrop == 'payments') echo 'active'; ?>">
                            <i class="nav-icon fas fa-money-bill-wave"></i>
                            <p>
                                Payments
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="new-payment.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/new-payment.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Payment</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?php if($showDrop == 'students') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link <?php if($showDrop == 'students') echo 'active'; ?>">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Students
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="new-student.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/new-student.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Student</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="students-list.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/students-list.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Students</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?php if($showDrop == 'reports') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link <?php if($showDrop == 'reports') echo 'active'; ?>">
                            <i class="nav-icon fas fa-chart-area"></i>
                            <p>
                                Reports
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="report1.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/report1.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Paid</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="report2.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/report2.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Not Paid</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="report3.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/report3.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Owing</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="report5.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/report5.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Student Report</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?php if($showDrop == 'users') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link <?php if($showDrop == 'users') echo 'active'; ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="new-user.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/new-user.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="users-list.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/users-list.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?php if($showDrop == 'settings') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link <?php if($showDrop == 'settings') echo 'active'; ?>">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./fees.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/fees.php') echo 'active'; ?>"">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Fees Structure</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./change-password.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/change-password.php') echo 'active'; ?>"">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Change Password</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        <?php } else if($uType == 'Bursar') {?>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="index.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/index.php') echo 'active'; ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview <?php if($showDrop == 'payments') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link <?php if($showDrop == 'payments') echo 'active'; ?>">
                            <i class="nav-icon fas fa-money-bill-wave"></i>
                            <p>
                                Payments
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="new-payment.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/new-payment.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Payment</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?php if($showDrop == 'students') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link <?php if($showDrop == 'students') echo 'active'; ?>">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Students
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="new-student.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/new-student.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Student</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="students-list.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/students-list.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Students</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?php if($showDrop == 'settings') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link <?php if($showDrop == 'settings') echo 'active'; ?>">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./fees.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/fees.php') echo 'active'; ?>"">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Fees Structure</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./change-password.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/change-password.php') echo 'active'; ?>"">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Change Password</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        <?php } else if($uType == 'Head') { ?>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="index.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/index.php') echo 'active'; ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview <?php if($showDrop == 'students') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link <?php if($showDrop == 'students') echo 'active'; ?>">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Students
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="students-list.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/students-list.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Students</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?php if($showDrop == 'reports') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link <?php if($showDrop == 'reports') echo 'active'; ?>">
                            <i class="nav-icon fas fa-chart-area"></i>
                            <p>
                                Reports
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="report1.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/report1.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Paid</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="report2.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/report2.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Not Paid</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="report3.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/report3.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Owing</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?php if($showDrop == 'users') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link <?php if($showDrop == 'users') echo 'active'; ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="new-user.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/new-user.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="users-list.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/users-list.php') echo 'active'; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?php if($showDrop == 'settings') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link <?php if($showDrop == 'settings') echo 'active'; ?>">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./change-password.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/pop-mgnt/admin/change-password.php') echo 'active'; ?>"">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Change Password</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        <?php } ?>
        
    </div>
    <!-- /.sidebar -->
</aside>