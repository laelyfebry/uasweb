<?php
@session_start();
include_once('database.php');


if (isset($_POST['bsimpan'])) {

    if ($_GET['hal'] == "edit") {

        // data akan diedit
        $edit = mysqli_query($conn, "UPDATE tbl_obat set
            Id_obat = '$_POST[Id_obat]',
            Nama_obat = '$_POST[Nama_obat]',
            Jumlah_obat = '$_POST[Jumlah_obat]',
            Ruangan = '$_POST[Ruangan]',
            NID = '$_POST[NID]'
            WHERE Id_obat='$_GET[id]'
            ");
        if ($edit) {
            echo "<script>
            alert('Edit berhasil');
            document.location='obatbck.php';
            </script>";
        } else {
            echo "<script>
            alert('Edit gagal');
            document.location='obatbck.php';
            </script>";
        }
    } else {
        if (isset($_POST['bsimpan'])) {
            $simpan = mysqli_query($conn, "INSERT INTO tbl_obat (Id_obat,Nama_obat,Jumlah_obat,Ruangan, NID)
                VALUES ('$_POST[Id_obat]','$_POST[Nama_obat]' ,'$_POST[Jumlah_obat]' , '$_POST[Ruangan]' , '$_POST[NID]')
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
    }
}

if (isset($_GET['hal'])) {
    //pengujian  jika edit data
    if ($_GET['hal'] == "edit") {
        $tampil = mysqli_query($conn, "SELECT * FROM tbl_obat WHERE Id_obat='$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            //jika data ditemukan maka data di tampung dulu ke variabel
            $vId_obat = $data['Id_obat'];
            $vNama_obatl = $data['Nama_obat'];
            $vJumlah_obat = $data['Jumlah_obat'];
            $vRuangan = $data['Ruangan'];
            $vNID = $data['NID'];
        }
    } elseif ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($conn, "DELETE FROM tbl_obat WHERE Id_obat='$_GET[id]'");
        if ($hapus) {
            echo "<script>
            alert('Hapus berhasil');
            document.location='obatbck.php';
            </script>";
        }
    }
}

$sql = 'SELECT * FROM tbl_obat LEFT JOIN tbl_dokter ON(tbl_obat.NID = tbl_dokter.NID)';
// if (isset($_GET['hal'])) {
//     $vd = $_GET['del'];
//     if ($_GET['hal'] == "del") {
//         $hapus = mysqli_query($conn, "DELETE  FROM tbl_matkul WHERE Id_Matkul='$vd'");
//         if ($hapus) {
//             echo "<script>alert('data berhasil dihapus');document.location='matakuliahbck.php'</script>";
//         } else {
//             echo "<script>alert('data gagal dihapus');document.location='matakuliahbck.php'</script>";
//         }
//     }
// }
$mat = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Puskesmas Darussalam </title>

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
                                    <h1 class="h3 mb-0 text-gray-800">DATA OBAT</h1>
                                </div>

                                <!-- Content Row -->

                                <div class="row">
                                    <!-- Content1 -->
                                    <div class="col-xl-12 col-lg-7">
                                        <div class="card shadow mb-4">
                                            <!-- Card Header - Dropdown -->
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-success text-center">DATA OBAT</h6>
                                            </div>
                                            <!-- form -->
                                            <div class="container mt-3">
                                                <div class="card">
                                                    <div class="card-header mb-3">
                                                        INPUT DATA OBAT
                                                    </div>
                                                    <div class="card-body">
                                                        <form method="post" action="" enctype="multipart/form-data">
                                                            <div class="form-group ">
                                                                <label>ID OBAT</label>
                                                                <input type="text" name="Id_obat" value="<?= @$vId_obat ?>" class="form-control" placeholder="Input Id Obat" required>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label>NAMA OBAT</label>
                                                                <input type="text" name="Nama_obat" value="<?= @$vNama_obatl ?>" class="form-control" placeholder="Input nama obat " required>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label>Jumlah</label>
                                                                <input type="text" name="Jumlah_obat" value="<?= @$vJumlah_obat ?>" class="form-control" placeholder="Input jumlah obat" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nama Dokter</label>
                                                                <select class="form-control" name="NID">
                                                                    <option value="<?= @$vNID ?>"><?= @$vNID ?></option>
                                                                    <?php
                                                                    $vi = 'SELECT * FROM tbl_obat RIGHT JOIN tbl_dokter ON(tbl_obat.NID = tbl_dokter.NID) ';
                                                                    $hasil = mysqli_query($conn, $vi);
                                                                    while ($tampil = mysqli_fetch_object($hasil)) {

                                                                        ?>
                                                                        <option value=<?= $tampil->NID ?>><?= $tampil->Nama_Dokter ?></option>

                                                                    <?php } ?>
                                                                </select>
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
                                                                    <th scope="col">KODE OBAT</th>
                                                                    <th scope="col">NAMA OBAT</th>
                                                                    <th scope="col">JUMLAH </th>
                                                                    <th scope="col">NAMA DOKTER</th>
                                                                    <th scope="col">ACTION</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                while ($data = mysqli_fetch_object($mat)) {

                                                                    ?>
                                                                    <tr>
                                                                        <th><?= $data->Id_obat ?></th>
                                                                        <td><?= $data->Nama_obat ?></td>
                                                                        <td><?= $data->Jumlah_obat ?></td>
                                                                        <td><?= $data->Ruangan ?></td>
                                                                        <td><?= $data->Nama_Dokter ?></td>
                                                                        <td>
                                                                            <a href="obatbck.php?hal=hapus&id=<?= $data->Id_obat ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini??')" class="btn btn-danger">Hapus</a>
                                                                            <a href="obatbck.php?hal=edit&id=<?= $data->Id_obat ?>" class="btn btn-outline-secondary">Edit</a>
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