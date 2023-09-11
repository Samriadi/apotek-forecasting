<?php
include 'fungsi.php';
error_reporting(0);

if(isset($_SESSION['login'])){
$nama = $_SESSION['nama'];
}else{
    $nama="user";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image" href="icon.png">
    <title>Apotek</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free-5.14.0-web/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
</head>

<body id="page-top" style="background-color: blue ;">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">Apotek Obat Rakyat</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- menu 1 -->
            <li class="nav-item" id="dashboard">
                <a class="nav-link" href="index.php">
                    <i class="fa fa-desktop" aria-hidden="true"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- menu 3 -->
             <?php if(isset($_SESSION['login'])):?>
                <li class="nav-item" id="adminid">
                <a class="nav-link" href="dataadmin.php">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>Data Admin
                    </span></a>
            </li>
            <li class="nav-item" id="datakasir">
                <a class="nav-link" href="datakasir.php">
                    <i class="fa fa-address-card" aria-hidden="true"></i>
                    <span>Data Kasir</span></a>
            </li>
            <?php endif;?>
            
            <!-- menu 4 -->
            <li class="nav-item" id="datapenjualan">
                <a class="nav-link" href="datapenjualan.php">
                    <i class="fa fa-address-card" aria-hidden="true"></i>
                    <span>Data Penjualan</span></a>
            </li>

            <li class="nav-item" id="dataobat">
                <a class="nav-link" href="dataobat.php">
                    <i class="fa fa-address-card" aria-hidden="true"></i>
                    <span>Data Obat</span></a>
            </li>
            <li class="nav-item" id="dataprediksi">
                <a class="nav-link" href="dataprediksi.php">
                    <i class="fa fa-address-card" aria-hidden="true"></i>
                    <span>Data Prediksi</span></a>
            </li>

            <li class="nav-item" id="datalaporan">
                <a class="nav-link" href="datalaporan.php">
                    <i class="fa fa-address-card" aria-hidden="true"></i>
                    <span>Data Laporan</span></a>
            </li>

            <li class="nav-item" id="datapembelian">
                <a class="nav-link" href="datapembelian.php">
                    <i class="fa fa-address-card" aria-hidden="true"></i>
                    <span>Data Pembelian</span></a>
            </li>
        
            </li>
            <?php if(isset($_SESSION['login'])||isset($_SESSION['kasir'])):?>
                <li class="nav-item" id="menu6">
                    <a class="nav-link" href="logout.php">
                        <i class="fa fa-outdent" aria-hidden="true"></i>
                        <span>Logout</span></a>
            </li>
            <?php else:?>
            <li class="nav-item" id="menu6">
                <a class="nav-link" href="login.php">
                    <i class="fa fa-indent" aria-hidden="true"></i>
                    <span>Login</span></a>
            </li>
            <li class="nav-item" id="menu6">
                <a class="nav-link" href="loginkasir.php">
                    <i class="fa fa-indent" aria-hidden="true"></i>
                    <span>Login Kasir</span></a>
            </li>
            <?php endif;?>
            

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
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php if($nama!=null){echo $nama;};?></span>
                    </ul>

                </nav>
                <!-- End of Topbar -->