<?php

    $showDrop = ''; // change between assets, reports, users, settings

    $url = $_SERVER['PHP_SELF'];

    if(
        $url == '/my-assets/admin/new-item.php' ||
        $url == '/my-assets/admin/info-item.php' ||
        $url == '/my-assets/admin/items-list.php' ||
        $url == '/my-assets/admin/edit-item.php'
    ){
        $showDrop = 'assets';
    }
    else if(
        $url == '/my-assets/admin/new-user.php' ||
        $url == '/my-assets/admin/edit-user.php' ||
        $url == '/my-assets/admin/users-list.php'
    ){
        $showDrop = 'users';
    }
    else if(
        $url == '/my-assets/admin/report.php'
    ){
        $showDrop = 'reports';
    }
    else if(
        $url == '/my-assets/admin/asset-types.php' ||
        $url == '/my-assets/admin/change-password.php'
    ){
        $showDrop = 'settings';
    }
    else{
        $showDrop = '';
    }

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="Admin Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">HCCL Assets</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['username'] ?? 'User'; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/my-assets/admin/index.php') echo 'active'; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?php if($showDrop == 'assets') echo 'menu-open'; ?>">
                    <a href="#" class="nav-link <?php if($showDrop == 'assets') echo 'active'; ?>">
                        <i class="nav-icon fas fa-list-ul"></i>
                        <p>
                            Assets
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="new-item.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/my-assets/admin/new-item.php') echo 'active'; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Asset</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="items-list.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/my-assets/admin/items-list.php') echo 'active'; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Assets</p>
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
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Report 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Report 2</p>
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
                            <a href="new-user.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/my-assets/admin/new-user.php') echo 'active'; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="users-list.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/my-assets/admin/users-list.php') echo 'active'; ?>">
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
                            <a href="./asset-types.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/my-assets/admin/asset-types.php') echo 'active'; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Asset Types</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./change-password.php" class="nav-link <?php if($_SERVER['PHP_SELF'] == '/my-assets/admin/change-password.php') echo 'active'; ?>"">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>