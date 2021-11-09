<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Belajar Kuy!</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('welcome') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Course
            </div>

            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('kategori/programming') ?>">
                    <i class="fas fa-user"></i>
                    <span>Programming</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('kategori/web_development') ?>">
                    <i class="fas fa-globe-asia"></i>
                    <span>Web Development</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('kategori/mobile_apps') ?>">
                    <i class="fab fa-android"></i>
                    <span>Mobile Apps</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('about_me') ?>">
                    <i class="fas fa-info-circle"></i>
                    <span>About Me</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

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

                    <!-- <?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?> -->
                    <!-- Topbar Search -->
                    <form method="POST" action="<?php if ("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" == "http://localhost/online_course/welcome") {
                                                    echo base_url('welcome/search');
                                                } else if ("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" == "http://localhost/online_course/dashboard") {
                                                    echo base_url('dashboard/search');
                                                } ?>" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input name="keyword" type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="navbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <?php $keranjang = 'Total Course : ' . $this->cart->total_items() . ' items' ?>
                                <?php echo anchor('dashboard/detail_keranjang', $keranjang)  ?>
                            </li>
                            <li></li>
                        </ul>

                    </div>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <ul class="na navbar-nav navbar-right">
                        <?php if ($this->session->userdata('username')) { ?>
                            <li>
                                <div>Selamat Datang <?php echo $this->session->userdata('nama') ?></div>
                            </li>
                            <li class="ml-3"><?php echo anchor('auth/logout', ' Logout') ?></li>
                        <?php } else { ?>
                            <li class="ml-3"><?php echo anchor('auth/login', ' Login') ?></li>
                        <?php } ?>
                    </ul>
                </nav>


                <!-- End of Topbar -->