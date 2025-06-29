<?php

session_start();
if (!isset($_SESSION['username'])) {
    // Jika belum login, kembalikan ke login
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Proses Absensi - SIPEDES</title>

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="Lambang_kabupaten_garut.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="css/sb-admin-2.min.css" rel="stylesheet">
   <!-- Custom styles for this page -->
   <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

  <div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon ml-2">
          <!-- <i class="fas fa-archive"></i> -->
           <img src="Lambang_kabupaten_garut.png" width="30" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">SIPEDES<sup>X</sup></div>
      </a>

      <hr class="sidebar-divider my-0">

      <li class="nav-item active">
        <a class="nav-link ml-1" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <hr class="sidebar-divider">


      <li class="nav-item">
        <a class="nav-link collapsed ml-1" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-list-alt"></i>
          <span>Absensi</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Absensi</h6>

            <a class="collapse-item" href="absensi.php">Absensi Harian <i class="fas fa-edit ml-1"></i></a>
            <a class="collapse-item" href="laporan_absensi.php">Laporan Absensi <i class="fas fa-file-alt ml-1"></i></a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed ml-1" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-database"></i>
          <span>Data</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Data</h6>
            <a class="collapse-item" href="pegawai.php">Pegawai <i class="fas fa-users ml-1"></i></a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link ml-1" href="about.php">
          <i class="fas fa-info-circle"></i>
          <span class="">Tentang</span></a>
      </li>


      <hr class="sidebar-divider d-none d-md-block">

      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                <i class="fas fa-user-circle"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
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

        <?php 
          //var_dump($_POST);die;
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tanggal_absensi = $_POST['tanggal_absensi'];
        
            // Melakukan sanitasi input untuk keamanan (sangat penting!)
            $tanggal_absensi = htmlspecialchars(strip_tags($tanggal_absensi));
            $filter = $_POST['filter_tanggal_absensi'];
            
            // list($bulan, $tahun) = explode('-', $filter_bulan_2);
            
            

            // koneksi ke database
            include 'config.php'; // pastikan koneksi ke database ada

            // Query data pegawai
            $query = "SELECT * FROM pegawai WHERE status_pegawai = 'aktif'";

            $pegawai = mysqli_query($conn, $query);
            //var_dump($tanggal_absensi);die;
          }
            // foreach($pegawai as $row) {
            //   $query = "INSERT INTO presensi(tanggal, nipd) VALUES ($tanggal_absensi, ". $row['nipd'] ."); ";
            //   mysqli_query($conn, )
            // }

            // 3. Menyiapkan dan Menjalankan Query SQL
            // Menggunakan Prepared Statements untuk mencegah SQL Injection (SANGAT DIREKOMENDASIKAN)
            
            
        ?>
        

            <div class="container-fluid">

            <div class="d-sm-flex align-items-center justify-content-left mb-4">
                <div>
                  <a href="absensi.php?filter_bulan_absensi=<?= $filter; ?>" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                </div>
                <h1 class="h3 ml-4 mb-0 text-gray-800">Halaman Proses Absensi</h1>
              </div>
                <form action="proses_tambah_absen.php" method="POST">
                   <input type="hidden" name="filter_bulan_absensi" value="<?= $filter ?>">
                  <input type="hidden" name="tanggal_absensi" value="<?= $tanggal_absensi ?>">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Absensi baru</h6>
                      <div class="row">
                        <div class="col-lg-8 col-md-10">
                            <select class="custom-select" name="multi_presensi" id="">
                                <option selected>Belum di dipilih</option>
                                <option value="1">Libur</option>
                                <option value="2">Hadir Tepat Waktu</option>
                                <option value="3">Hadir Telat</option>
                                <option value="4">Tugas Luar</option>
                                <option value="5">Izin</option>
                                <option value="6">Tidak Hadir</option>
                              </select>
                        </div>
                        <div class="col-lg-2 col-md-6">
                          <button class="btn btn-primary">Submit</button>
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="card-body">

                      <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th class="text-left" >NIPD</th>
                            <th class="text-left">Nama</th>
                            <th class="text-center">Presensi</th>
                            <th class="text-center">Pilih</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1; ?>
                          <?php foreach ($pegawai as $data) { ?>
                            <tr>
                              <td><?php echo $data['nipd'] ?></td>
                              <input type="hidden" name="nipd_pegawai_<?= $i ?>" value="<?= $data['nipd']; ?>">
                            <td><?php echo $data['nama_lengkap'] ?></td>
                            <td>
                            <div class="input-group m-0 p-0">
                              <select aria-readonly="true" class="custom-select" name="<?php echo 'status_presensi_'.$i ?>" id="" disabled>
                                <option selected>Belum di catat</option>
                                <option value="1">Libur</option>
                                <option value="2">Hadir Tepat Waktu</option>
                                <option value="3">Hadir Telat</option>
                                <option value="4">Tugas Luar</option>
                                <option value="5">Izin</option>
                                <option value="6">Tidak Hadir</option>
                              </select>
                            </div>
                            </td>
                            <td class="text-center">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <input type="checkbox" name="<?php echo 'presensi_pegawai_'.$i ?>">
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <?php $i++ ?>
                          <?php } ?> 
                         
                      </tbody>
                    </table>
                    
              </div>
              </form>
        
            
        
      </div>
    </div>

          

          

          
          </div>
        </div>
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Kelompok 5 Basis Data (D) ITG 2025</span>
          </div>
        </div>
      </footer>
      </div>
    </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Tekan tombol 'logout' dibawah untuk mengakhiri sesi</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <script src="js/sb-admin-2.min.js"></script>

  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>