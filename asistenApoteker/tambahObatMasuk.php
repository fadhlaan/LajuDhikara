<!DOCTYPE html>
<html lang="en">
<?php
require '../config.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Query untuk tabel periode (bulan)
$queryPeriodeBulan = "SELECT id_periode, bulan FROM periode ORDER BY bulan";
$resPeriodeBulan = mysqli_query($conn, $queryPeriodeBulan);
if (!$resPeriodeBulan) {
    die("Query failed: " . mysqli_error($conn));
}

// Query untuk tabel periode (tahun)
$queryPeriodeTahun = "SELECT id_periode, tahun FROM periode ORDER BY tahun";
$resPeriodeTahun = mysqli_query($conn, $queryPeriodeTahun);
if (!$resPeriodeTahun) {
    die("Query failed: " . mysqli_error($conn));
}

// Query untuk tabel obat
$queryObat = "SELECT id_obat, nama_obat FROM obat ORDER BY nama_obat";
$resObat = mysqli_query($conn, $queryObat);
if (!$resObat) {
    die("Query failed: " . mysqli_error($conn));
}
// Query untuk tabel jenis
$queryJenis = "SELECT id_jenis, nama_jenis FROM jenis ORDER BY nama_jenis";
$resJenis = mysqli_query($conn, $queryJenis);
if (!$resJenis) {
    die("Query failed: " . mysqli_error($conn));
}

// Query untuk tabel satuan
$querySatuan = "SELECT id_satuan, nama_satuan FROM satuan ORDER BY nama_satuan";
$resSatuan = mysqli_query($conn, $querySatuan);
if (!$resSatuan) {
    die("Query failed: " . mysqli_error($conn));
}

// Query untuk tabel supplier
$querySupplier = "SELECT id_supplier, nama_supplier FROM supplier ORDER BY nama_supplier";
$resSupplier = mysqli_query($conn, $querySupplier);
if (!$resSupplier) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tambah Obat</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon icon-size">
                    <img src="../img/Logo.png" alt="Logo" style="width: 50px; height: 50px;">
                </div>
                <div class="sidebar-brand-text mx-3" style="font-size: smaller;">PT. Laju Dhikara Abadi</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Beranda -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Beranda</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="obat.php"><i class="fas fa-pills"></i> Obat</a>
                        <a class="collapse-item" href="supplier.php"><i class="fas fa-truck"></i> Supplier</a>
                        <a class="collapse-item" href="jenis.php"><i class="fas fa-share-alt"></i> Jenis</a>
                        <a class="collapse-item" href="satuan.php"><i class="fas fa-cog"></i> Satuan</a>
                        <a class="collapse-item" href="periode.php"><i class="fas fa-calendar"></i> Periode</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="obatMasuk.php">
                    <i class="fas fa-fw fa-dolly-flatbed"></i>
                    <span>Obat Masuk</span></a>
            </li>


            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="obatKeluar.php">
                    <i class="fas fa-fw fa-money-bill-wave"></i>
                    <span>Obat Keluar</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="pembelian.php">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Pembelian</span></a>
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

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tambah Obat Masuk</h1>

                    <!-- Form Tambah Obat -->
                    <form method="POST" action="prosesTambahObatMasuk.php">
                        <div class="form-group">
                            <label for="bulan">Bulan:</label>
                            <select class="form-control" id="bulan" name="bulan" required>
                                <?php while ($rowBulan = mysqli_fetch_assoc($resPeriodeBulan)) : ?>
                                    <option value="<?= $rowBulan['id_periode']; ?>"><?= $rowBulan['bulan']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun:</label>
                            <select class="form-control" id="tahun" name="tahun" required>
                                <?php while ($rowTahun = mysqli_fetch_assoc($resPeriodeTahun)) : ?>
                                    <option value="<?= $rowTahun['id_periode']; ?>"><?= $rowTahun['tahun']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_obat">Nama Obat:</label>
                            <select class="form-control" id="nama_obat" name="nama_obat" required>
                                <?php while ($rowObat = mysqli_fetch_assoc($resObat)) : ?>
                                    <option value="<?= $rowObat['id_obat']; ?>"><?= $rowObat['nama_obat']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_penerimaan">Jumlah Penerimaan:</label>
                            <input type="number" class="form-control" id="jumlah_penerimaan" name="jumlah_penerimaan" required >
                        </div>  
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
