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

  <title>Laporan Absensi - SIPEDES</title>

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="Lambang_kabupaten_garut.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="css/sb-admin-2.min.css" rel="stylesheet" media="all">
    <style>
    @media print {
      /* body * {
        visibility: hidden;
      }
      .card, .card * {
        visibility: visible;
      }
      .card {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }
      .hidden-print{
        display: none;
      }

      .no-print{
        display: none;
      } */
      
    }
    .status-Libur { background-color: lightgray; }
    .status-Hadir-Tepat-Waktu { 
      background-color: white;
      font-weight: bold;
    }
      .status-Tugas-Luar { background-color: lightblue; font-weight: bold; }
      .status-Izin { background-color: lightblue; font-weight: bold;}
      .status-Hadir-Telat { background-color: yellow; font-weight: bold;}
      .status-Tidak-Masuk { background-color: red; font-weight: bold; }

      .table td,
      .table th {
        padding: 4px 6px; /* nilai default Bootstrap adalah 12px 15px */
        font-size: 12px;   /* kecilkan teks bila perlu */
      }
      
  </style>

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

      <li class="nav-item">
        <a class="nav-link ml-1" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <hr class="sidebar-divider">


      <li class="nav-item active">
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
        <div class="container-fluid">

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan Presensi Kehadiran</h1>
            
            </div>
            <?php
                include 'config.php';
                $filter_bulan = date('m-Y');
                
                if(isset($_GET['filter_bulan_absensi'])){
                  $filter_bulan = $_GET['filter_bulan_absensi'];
                }
                list($bulan, $tahun) = explode('-', $filter_bulan);
                $formatTanggal = DateTime::createFromFormat('m-Y', $filter_bulan);
                $bulanAbsen = $formatTanggal->format('F Y');
                //var_dump($bulan, $tahun);die;
                
                $querylaporan = "SELECT kode_status, COUNT(*) AS jumlah
                                  FROM presensi
                                  WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun
                                  GROUP BY kode_status;";
                $laporan_status = mysqli_query($conn, $querylaporan);
                
                // Inisialisasi array default 0
                $jumlahStatus = [
                  2 => 0, // Hadir Tepat Waktu
                  3 => 0, // Hadir Telat
                  4 => 0, // Tugas Luar
                  5 => 0, // Izin
                  6 => 0, // Tidak Hadir
                ];

                // Masukkan hasil query ke array
                while ($row = mysqli_fetch_assoc($laporan_status)) {
                  $kode = (int)$row['kode_status'];
                  if (isset($jumlahStatus[$kode])) {
                    $jumlahStatus[$kode] = $row['jumlah'];
                  }
                }

                //var_dump($laporan);
               
                  
                  // var_dump($result);die;
            ?>
            <div class="row">
                  <div class="col-lg-12">
                    <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                      <h6 class="h4 m-0 font-weight-bold text-primary">Informasi Absensi</h6>
                      <form action="laporan_absensi.php" method="get">
                        <div class="row">
                          <div class="col-12">
                          <select class="form-control" name="filter_bulan_absensi" onchange="this.form.submit()">
                             <option value="01-2025" <?= ($filter_bulan ?? '') == '01-2025' ? 'selected' : '' ?>>Januari 2025</option>
                            <option value="02-2025" <?= ($filter_bulan ?? '') == '02-2025' ? 'selected' : '' ?> >Febuari 2025</option>
                            <option value="03-2025" <?= ($filter_bulan ?? '') == '03-2025' ? 'selected' : '' ?> >Maret 03/2025</option>
                            <option value="04-2025" <?= ($filter_bulan ?? '') == '04-2025' ? 'selected' : '' ?> >April 04/2025</option>
                            <option value="05-2025" <?= ($filter_bulan ?? '') == '05-2025' ? 'selected' : '' ?> >Mei 2025</option>
                            <option value="06-2025" <?= ($filter_bulan ?? '') == '06-2025' ? 'selected' : '' ?> >Juni 2025</option>
                            <option value="07-2025" <?= ($filter_bulan ?? '') == '07-2025' ? 'selected' : '' ?> >Juli 2025</option>
                            <option value="08-2025" <?= ($filter_bulan ?? '') == '08-2025' ? 'selected' : '' ?> >Agustus 2025</option>
                            <option value="09-2025" <?= ($filter_bulan ?? '') == '09-2025' ? 'selected' : '' ?> >September 2025</option>
                            <option value="10-2025" <?= ($filter_bulan ?? '') == '10-2025' ? 'selected' : '' ?> >Oktober 2025</option>
                            <option value="11-2025" <?= ($filter_bulan ?? '') == '11-2025' ? 'selected' : '' ?> >Novermber 2025</option>
                            <option value="12-2025" <?= ($filter_bulan ?? '') == '12-2025' ? 'selected' : '' ?> >Desember 2025</option>
                          </select>
                          </div>
                            
                        </div>
                      </form>
                    </div>
                    <div class="card-body">

                    
                    
              

          <div class="row">

            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Hadir Tepat Waktu</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="text-primary fas fa-user mr-1"></i> <?= $jumlahStatus[2] ?> </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clock fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tugas Luar</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="text-success fas fa-user mr-1"></i><?= $jumlahStatus[4] ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-business-time fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Izin</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><i class="text-info fas fa-user mr-1"></i><?= $jumlahStatus[5] ?></div>
                        </div>

                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Hadir Telat</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="text-warning fas fa-user mr-1"></i><?= $jumlahStatus[3] ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clock fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Tidak Masuk</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="text-danger fas fa-user mr-1"></i><?= $jumlahStatus[6] ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-times fa-2x text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="row">

          <?php
          
                // Inisialisasi jumlah kehadiran per minggu
                $status_data = [
                  1 => [0, 0, 0, 0], // Tidak Hadir
                  2 => [0, 0, 0, 0], // Hadir Tepat Waktu
                  3 => [0, 0, 0, 0], // Tugas Luar
                  4 => [0, 0, 0, 0], // Hadir Telat
                  5 => [0, 0, 0, 0], // Izin
                  6 => [0, 0, 0, 0], // Izin
                ];
                

                // Query semua presensi yang hadir di bulan itu
                $query = "
                  SELECT tanggal, kode_status
                  FROM presensi
                  WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'
                ";

                $laporan_presensi_mingguan = mysqli_query($conn, $query);

                  while ($row = mysqli_fetch_assoc($laporan_presensi_mingguan)) {
                    $tanggal = $row['tanggal'];
                    $kode = $row['kode_status'];
                    $minggu = ceil(date('j', strtotime($tanggal)) / 7);
                
                    if (isset($status_data[$kode]) && $minggu >= 1 && $minggu <= 4) {
                        $status_data[$kode][$minggu - 1]++;
                    }
                }
          ?>   
          
          

            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="h5 m-0 font-weight-bold text-primary">Overview Presensi <?= $bulanAbsen ?></h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Aksi</div>
                      <a class="dropdown-item " href="#" onclick="printChart()">Cetak <i class="fas fa-print"></i></a>
                    </div>
                  </div>
                </div>
                <div class="card-body print-chart-area">
                <h6 class="m-0 mb-2 font-weight-bold text-primary">Laporan bulanan Presensi <?= $bulanAbsen ?></h6>
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-5 ">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Visualisasi Perbandingan</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Aksi</div>
                      <a class="dropdown-item" href="#" onclick="printChartPerbandingan()">Cetak <i class="fas fa-print"></i></a>
                    </div>
                  </div>
                </div>
                <div class="card-body print-chart-area-perbandingan">
                <h6 class="text-center m-0 font-weight-bold text-primary">Presensi <?= $bulanAbsen ?></h6>
                  <div class="chart-pie pt-4 pb-2 mt-n2">
                  
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-2 text-center small">
                    <span class="mr-3">
                      <i class="fas fa-circle text-primary"></i> Hadir Tepat Waktu
                    </span>
                    <span class="mr-3">
                      <i class="fas fa-circle text-success"></i> Tugas Luar
                    </span>
                    <span class="mr-3">
                      <i class="fas fa-circle text-info"></i> Izin
                    </span>
                    <span class="mr-3">
                      <i class="fas fa-circle text-warning"></i> Hadir Telat
                    </span>
                    <span class="mr-3">
                      <i class="fas fa-circle text-danger"></i> Tidak Masuk
                    </span>
                  </div>
                </div>
              </div>
            </div>


          </div>


          <?php 
          
          $query = "
                    SELECT p.nipd, pg.nama_lengkap, DAY(p.tanggal) as hari, s.deskripsi AS status
                    FROM presensi p
                    JOIN pegawai pg ON p.nipd = pg.nipd
                    JOIN status_presensi s ON p.kode_status = s.kode_status
                    WHERE MONTH(p.tanggal) = '$bulan' AND YEAR(p.tanggal) = '$tahun'
                    ORDER BY p.nipd ASC, p.tanggal ASC
                  ";

                  $laporan_absen_bulanan = mysqli_query($conn, $query);
          // var_dump($laporan_bulanan[0]);die;


          $rekap = []; // Menyimpan data presensi per nipd

            while ($row = mysqli_fetch_assoc($laporan_absen_bulanan)) {
                $nipd = $row['nipd'];
                $nama = $row['nama_lengkap'];
                $hari = (int)$row['hari'];
                $status = $row['status']; // H, TL, I, A, dll

                if (!isset($rekap[$nipd])) {
                    $rekap[$nipd] = [
                        'nama' => $nama,
                        'presensi' => array_fill(1, 31, '') // Inisialisasi 31 hari
                    ];
                }

                $rekap[$nipd]['presensi'][$hari] = $status;
            }

           

              foreach ($rekap as $nipd => $data) {
                $hadir = 0;
                foreach ($data['presensi'] as $status) {
                    if ($status === 'Hadir Tepat Waktu') {
                      $hadir++;
                    }else if ($status === 'Hadir Telat'){
                      $hadir = $hadir + 0.6;
                    }else if ($status === 'Tugas Luar' || $status === 'Izin') {
                      $hadir = $hadir + 0.5;
                    }
                      
                    
                }
                $hadir = round($hadir);
                $rekap[$nipd]['hadir'] = $hadir;
                $rekap[$nipd]['total'] = 17; // Misalnya jumlah hari kerja aktif
                $rekap[$nipd]['persen'] = round(($hadir / $rekap[$nipd]['total']) * 100, 2);
            }
          ?>

          <div class="row" id="laporan_presensi_bulanan">
            <div class="col-lg-12" >
              <div class="card shadow mb-4">
              <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Presensi <?= $bulanAbsen ?></h6>
                <div class="dropdown no-arrow no-print">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Aksi</div>
                    <a class="dropdown-item" href="laporan_bulanan.php" target="_blank">Cetak <i class="fas fa-print"></i></a>
                  </div>
                </div>
              </div>
                <div class="card-body"    >
                  <div class="table-responsive" >
                    <table class="table table-bordered tb-sm"  cellspacing="0">
                      <thead>
                        <tr>
                          <th class="text-center" rowspan="2">NIPD</th>
                          <th class="p-0 m-0 text-center" rowspan="2">Nama</th>
                          <th class="text-center" colspan="31">Presensi</th>
                          <th class="p-0 m-0 text-center" rowspan="2">Keterangan</th>
                        </tr>
                        <tr>
                          <!-- <th colspan="2"></th> -->
                          <?php for ($i = 1; $i <= 31; $i++) : ?>
                            <th><?php echo $i; ?></th>
                          <?php endfor; ?>
                        </tr>
                      </thead>
                      <tbody>
                    <?php  foreach ($rekap as $nipd => $data) { 
                      echo "<tr>";
                      echo "<td>$nipd</td>";
                      echo "<td>{$data['nama']}</td>";
                  
                      for ($i = 1; $i <= 31; $i++) {
                        if (isset($data['presensi'][$i])) {
                          $status = $data['presensi'][$i];
                        } else {
                            $status = ''; // Kosongkan jika tidak ada data (misal tgl 29-31 Februari)
                        }
                          $color = '';
                          //var_dump($status);
                          switch ($status) {
                              case 'Libur': echo "<td class='bg-light'></td>"; break;
                              case 'Hadir Tepat Waktu': echo "<td class='bg-light'>H</td>"; break;
                              case 'Tugas Luar':  echo "<td class='bg-info'>TL</td>"; break;
                              case 'Izin': echo "<td class='bg-info'>I</td>"; break;
                              case 'Hadir Telat': echo "<td class='bg-warning'>H</td>"; break;
                              case 'Tidak Hadir': echo "<td class='bg-danger'></td>"; break;
                              case '': echo "<td></td>"; break;
                          }
                          
                      }
                  
                      echo "<td>{$data['hadir']}/{$data['total']} : {$data['persen']}%</td>";
                      echo "</tr>";
                  
                      } ?>
                        
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
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

  <script src="js/demo/chart-area-demo.js"></script>
  
  <script>
     var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Minggu ke-1", "Minggu ke-2", "Minggu ke-3", "Minggu ke-4"],
        datasets: [
          {
            label: "Hari libur",
            borderColor: "rgba(222, 222, 222, 1)", // abu abu
            backgroundColor: "rgba(200, 200, 200, 1)",
            data: [
              <?= $status_data[1][0] ?>,
              <?= $status_data[1][1] ?>,
              <?= $status_data[1][2] ?>,
              <?= $status_data[1][3] ?>
            ]
          },
          {
            label: "Hadir Tepat Waktu",
            borderColor: "#1d4ed8", // biru tua
            backgroundColor: "rgba(29, 78, 216, 1)",
            data: [
              <?= $status_data[2][0] ?>,
              <?= $status_data[2][1] ?>,
              <?= $status_data[2][2] ?>,
              <?= $status_data[2][3] ?>
            ]
          },
          {
            label: "Tugas Luar",
            borderColor: "#10b981", // hijau
            backgroundColor: "rgba(16, 185, 129, 1)",
            data: [
              <?= $status_data[3][0] ?>,
              <?= $status_data[3][1] ?>,
              <?= $status_data[3][2] ?>,
              <?= $status_data[3][3] ?>
            ]
          },
          {
            label: "Hadir Telat",
            borderColor: "#facc15", // kuning
            backgroundColor: "rgba(250, 204, 21, 1)",
            data: [
              <?= $status_data[4][0] ?>,
              <?= $status_data[4][1] ?>,
              <?= $status_data[4][2] ?>,
              <?= $status_data[4][3] ?>
            ]
          },
          {
            label: "Izin",
            borderColor: "#38bdf8", // biru muda
            backgroundColor: "rgba(56, 189, 248, 1)",
            data: [
              <?= $status_data[5][0] ?>,
              <?= $status_data[5][1] ?>,
              <?= $status_data[5][2] ?>,
              <?= $status_data[5][3] ?>
            ]
          },
          {
            label: "Tidak Hadir",
            borderColor: "#ef4444", // merah
            backgroundColor: "rgba(239, 68, 68, 1)",
            data: [
              <?= $status_data[6][0] ?>,
              <?= $status_data[6][1] ?>,
              <?= $status_data[6][2] ?>,
              <?= $status_data[6][3] ?>
            ]
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true,
              stepSize: 7,
            }
          }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
              return data.datasets[tooltipItem.datasetIndex].label + ": " + tooltipItem.yLabel;
            }
          }
        }
      }
    });

  

  </script>

 <!-- <script src="js/demo/chart-pie-demo.js"></script> -->

  <script>
    // Set new default font family and font color to mimic Bootstrap's default styling
      Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
      Chart.defaults.global.defaultFontColor = '#858796';

      // Pie Chart Kehadiran
      var ctx = document.getElementById("myPieChart");
      var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ["Hadir Tepat Waktu", "Tugas Luar", "Izin", "Hadir Telat","Tidak Masuk"],
          datasets: [{
            data: [
              <?= $jumlahStatus['2'] ?>,
              <?= $jumlahStatus['4'] ?>, 
              <?= $jumlahStatus['5'] ?>, 
              <?= $jumlahStatus['3'] ?>, 
              <?= $jumlahStatus['6'] ?>
            ], // Sesuaikan data sesuai kondisi kehadiran
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#e4a11b', '#e74a3b'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#abad15', '#be2617'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
          }],
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
          },
          legend: {
            display: false
          },
          cutoutPercentage: 80,
        },
      });
  </script>
  <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
  <script src="js/demo/print.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</body>

</html>