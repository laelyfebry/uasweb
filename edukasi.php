<?php
@session_start();
include 'database.php';

$tampil = mysqli_query($conn, "SELECT * FROM tbl_obat LEFT JOIN tbl_dokter ON(tbl_obat.NID = tbl_dokter.NID) WHERE Id_obat='$_GET[id]'");
$data = mysqli_fetch_array($tampil);
if ($data) {
    //jika data ditemukan maka data di tampung dulu ke variabel
    $vNama_obat = $data['vNama_obat'];
    $vNama_Dokter = $data['vNama_Dokter'];
    $vId_obat = $data['Id_obat'];
}
if (isset($_POST['bsimpan'])) {
    $simpan = mysqli_query($conn, "INSERT INTO tbl_materi (Id_obat,NID,Pertanyaan)
        VALUES ('$vId_obat','$_POST[NID]' ,'$_POST[Pertanyaan]')
        ");
    if ($simpan) {
        echo "<script>
        alert('Simpan berhasil');
        document.location='obatbck.php';
        </script>";
    } else {
        echo "<script>
        alert('Simpan gagal');
        document.location='obatbck.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Pskesmas Darussalam </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-text mx-3">Puskesmas Darussalam</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="admin.php">
                    <span>Home</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">



                <!-- Nav Item  -->
                <li class="nav-item">
                    <a class="nav-link" href="pasienbck.php">
                        <span>Tambah_Pasien</span></a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <li class="nav-item">
                        <a class="nav-link" href="dokterbck.php">
                            <span>Tambah_Dokter</span></a>
                        </li>

                        <!-- Divider -->
                        <hr class="sidebar-divider">
                        <li class="nav-item">
                            <a class="nav-link" href="obatbck.php">
                                <span>Tambah_Dokter</span></a>
                            </li>

                            <!-- Divider -->
                            <hr class="sidebar-divider">
                            <li class="nav-item">
                                <a class="nav-link" href="materi.php">
                                    <span>Materi</span></a>
                                </li>

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

                                            <!-- Nav Item - User Information -->
                                            <li class="nav-item dropdown no-arrow">
                                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>

                                            </a>
                                        </li>

                                    </ul>
                                </nav>
                                <!-- End of Topbar -->

                                <!-- Begin Page Content -->
                                <div class="container-fluid">

                                    <!-- Page Heading -->
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h1 class="h3 mb-0 text-gray-800">TUGAS</h1>
                                    </div>

                                    <div class="container mt-3">
                                        <div class="card">
                                            <div class="card-header mb-3">
                                                INPUT DATA TUGAS
                                            </div>
                                            <!-- end -->

                                            <!-- Card Body -->
                                            <div class="card-body">


                                                <h2 class="text-center">Obat : <?= $vNama_obat ?></h2>
                                                <h3 class="text-center">Dokter : <?= $vNama_Dokter ?></h3>

                                                <form method="post" action="" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label>Soal</label>
                                                        <textarea class="form-control" name="Pertanyaan" placeholder="isikan dengan pertanya...." required><?= @$vAlamat ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pilih Pasien</label>
                                                        <select class="form-control" name="NID">
                                                            <option value="<?= @$vNID ?>"><?= @$vNID ?></option>
                                                            <?php
                                                            $vi = 'SELECT * FROM tbl_pasien';
                                                            $hasil = mysqli_query($conn, $vi);
                                                            while ($tampil = mysqli_fetch_object($hasil)) {

                                                                ?>
                                                                <option value=<?= $tampil->NID ?>><?= $tampil->Nama ?></option>

                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Content Wrapper -->

                            </div>
                            <!-- End of Page Wrapper -->



                            <!-- Bootstrap core JavaScript-->
                            <script src="vendor/jquery/jquery.min.js"></script>
                            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                            <!-- Core plugin JavaScript-->
                            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                            <!-- Custom scripts for all pages-->
                            <script src="js/sb-admin-2.min.js"></script>

                            <!-- Page level plugins -->
                            <script src="vendor/chart.js/Chart.min.js"></script>

                            <!-- Page level custom scripts -->
                            <script src="js/demo/chart-area-demo.js"></script>
                            <script src="js/demo/chart-pie-demo.js"></script>

                        </body>

                        </html>