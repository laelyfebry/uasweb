<?php
@session_start();
include_once('database.php');

if (isset($_POST['bsimpan'])) {

    if ($_GET['hal'] == "edit") {

        // data akan diedit
        $edit = mysqli_query($conn, "UPDATE tbl_dokter set
            NID = '$_POST[NIP]',
            Nama_Dokter = '$_POST[Nama_Dokter]',
            Jenis_Kelamin = '$_POST[Jenis_Kelamin]',
            Alamat = '$_POST[Alamat]',
            Telpon = '$_POST[Telpon]',
            Pw = '$_POST[Pw]'
            WHERE NIP='$_GET[id]'
            ");
        if ($edit) {
            echo "<script>
            alert('Edit berhasil');
            document.location='dokterbck.php';
            </script>";
        } else {
            echo "<script>
            alert('Edit gagal');
            document.location='dokterbck.php';
            </script>";
        }
    } else {

        if (isset($_POST['bsimpan'])) {
            $simpan = mysqli_query($conn, "INSERT INTO tbl_dokter (NID ,Nama_Dokter, Jenis_Kelamin,  Alamat, Telpon, Pw)
                VALUES ('$_POST[NID]','$_POST[Nama_Dokter]' ,'$_POST[Jenis_Kelamin]' , '$_POST[Alamat]' , '$_POST[Telpon]', '$_POST[Pw]')
                ");
            if ($simpan) {
                echo "<script>
                alert('Simpan berhasil');
                document.location='dokterbck.php';
                </script>";
            } else {
                echo "<script>
                alert('Simpan gagal');
                document.location='dokterbck.php';
                </script>";
            }
        }
    }
}

if (isset($_GET['hal'])) {
    //pengujian  jika edit data
    if ($_GET['hal'] == "edit") {
        $tampil = mysqli_query($conn, "SELECT * FROM tbl_dokter WHERE NID='$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            //jika data ditemukan maka data di tampung dulu ke variabel
            $vNIP = $data['NID'];
            $vNama_Dosen = $data['Nama_Dokter'];
            $vJenis_Kelamin = $data['Jenis_Kelamin'];
            $vAlamat = $data['Alamat'];
            $vTelpon = $data['Telpon'];
            $vPw = $data['Pw'];
        }
    } elseif ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($conn, "DELETE FROM tbl_dokter WHERE NID='$_GET[id]'");
        if ($hapus) {
            echo "<script>
            alert('Hapus berhasil');
            document.location='dokterbck.php';
            </script>";
        }
    }
}
$sql = 'SELECT * FROM tbl_dokter';
$dosen = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Puskesmas Darussalam</title>

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
                    <a class="nav-link" href="mahasiswabck.php">
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
                                <span>Tambah_Obat</span></a>
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
                            <div class="container-fluid">

                                <!-- Page Heading -->
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 text-gray-800">DATA DOKTER</h1>
                                </div>

                                <!-- Content Row -->

                                <div class="row">
                                    <!-- Content1 -->
                                    <div class="col-xl-12 col-lg-7">
                                        <div class="card shadow mb-4">
                                            <!-- Card Header - Dropdown -->
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-success text-center">DATA DOKTER</h6>
                                            </div>
                                            <!-- form -->
                                            <div class="container mt-3">
                                                <div class="card">
                                                    <div class="card-header mb-3">
                                                        INPUT DATA DOKTER
                                                    </div>
                                                    <div class="card-body">
                                                        <form method="post" action="" enctype="multipart/form-data">
                                                            <div class="form-group ">
                                                                <label>NID</label>
                                                                <input type="text" name="NID" value="<?= @$vNID ?>" class="form-control" placeholder="Input NID" required>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label>NAMA</label>
                                                                <input type="text" name="Nama_Dokter" value="<?= @$vNama_Dokter ?>" class="form-control" placeholder="Input NAMA DOKTER " required>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label>NO TELPON</label>
                                                                <input type="text" name="Telpon" value="<?= @$vTelpon ?>" class="form-control" placeholder="Input NO TELPON" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>JENIS KELAMIN</label>
                                                                <select class="form-control" name="Jenis_Kelamin">
                                                                    <option value="<?= @$vJenis_Kelamin ?>"><?= @$vJenis_Kelamin ?></option>
                                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                                    <option value="Perempuan">Perempuan</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>ALAMAT</label>
                                                                <textarea class="form-control" name="Alamat" placeholder="ALAMAT ANDA" required><?= @$vAlamat ?></textarea>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label>Password</label>
                                                                <input type="Password" name="Pw" value="<?= @$vPw ?>" class="form-control" placeholder="Input Password" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
                                                            <button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>
                                                        </form>
                                                    </div>
                                                    <!-- end -->

                                                    <!-- Card Body -->
                                                    <div class="card-body">

                                                        <table class="table table-hover ">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">NID</th>
                                                                    <th scope="col">NAMA DOKTER</th>
                                                                    <th scope="col">JENIS KELAMIN </th>
                                                                    <th scope="col">ALAMAT</th>
                                                                    <th scope="col">TELPON</th>
                                                                    <th scope="col">ACTION</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                while ($data = mysqli_fetch_object($dosen)) {

                                                                    ?>
                                                                    <tr>
                                                                        <th><?= $data->NID ?></th>
                                                                        <td><?= $data->Nama_Dokter ?></td>
                                                                        <td><?= $data->Jenis_Kelamin ?></td>
                                                                        <td><?= $data->Alamat ?></td>
                                                                        <td><?= $data->Telpon ?></td>
                                                                        <td>
                                                                            <a href="dokterbck.php?hal=edit&id=<?= $data->NID ?>" class="btn btn-outline-secondary">Edit</a>
                                                                            <a href="dokterbck.php?hal=hapus&id=<?= $data->NID ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini??')" class="btn btn-danger">Hapus</a>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
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