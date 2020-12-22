<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin') ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-cog"></i>
            </div>
            <div class="sidebar-brand-text mx-3"href="<?php echo base_url('admin') ?>">Config</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <?php if ($this->session->username == 'admin'): ?>
        <li class="nav-item <?php if ($side_active == 'judul') echo 'active' ?>">
            <a class="nav-link" href="<?php echo base_url('admin') ?>">
                <i class="fas fa-font"></i>
                <span>Judul</span>
            </a>
        </li>

        <li class="nav-item <?php if ($side_active == 'logo') echo 'active' ?>">
            <a class="nav-link" href="<?php echo base_url('admin/logo') ?>">
                <i class="fas fa-image"></i>
                <span>Logo</span>
            </a>
        </li>
        <?php endif; ?>

        <li class="nav-item <?php if ($side_active == 'batas') echo 'active' ?>">
            <a class="nav-link" href="<?php echo base_url('admin/batas') ?>">
                <i class="fas fa-tachometer-alt"></i>
                <span>Batas</span>
            </a>
        </li>

        <li class="nav-item <?php if ($side_active == 'histori') echo 'active' ?>">
            <a class="nav-link" href="<?php echo base_url('admin/histori') ?>">
                <i class="fas fa-history"></i>
                <span>Histori</span>
            </a>
        </li>

        <li class="nav-item <?php if ($side_active == 'pindah') echo 'active' ?>">
            <a class="nav-link" href="<?php echo base_url('admin/pindah') ?>">
                <i class="fas fa-database"></i>
                <span>Pindah Data TRX</span>
            </a>
        </li>

        <?php if ($this->session->username == 'admin'): ?>
            <li class="nav-item <?php if ($side_active == 'user') echo 'active' ?>">
                <a class="nav-link" href="<?php echo base_url('admin/user') ?>">
                    <i class="fas fa-user"></i>
                    <span>User</span>
                </a>
            </li>
        <?php endif; ?>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link" href="#" id="userDropdown">
                            <span class="mr-2 d-none d-lg-inline text-gray-600"><i class="fas fa-user"></i>&nbsp;<?php echo $this->session->username ?></span>
                        </a>
                    </li>
                </ul>

                <a class="btn btn-primary btn-circle" href="<?php echo base_url() ?>"><i class="fas fa-home"></i></a>&nbsp;
                <!-- <a class="btn btn-danger btn-circle" href="<?php echo base_url() ?>"><i class="fas fa-sign-out-alt"></i></a> -->
                <button id="btnLogout" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#modalLogout"><i class="fas fa-sign-out-alt"></i></button>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
