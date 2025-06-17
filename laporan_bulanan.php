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

  <title>Laporan Bulanan Absensi - SIPEDES</title>

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="Lambang_kabupaten_garut.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
   
    .status-Libur { background-color: lightgray; }
    .status-Hadir-Tepat-Waktu { 
      background-color: white;
     
      color: black;
    }
      .status-Tugas-Luar { background-color: lightblue; color: black; }
      .status-Izin { background-color: lightblue;  color: black;}
      .status-Hadir-Telat { background-color: yellow;  color: black;}
      .status-Tidak-Hadir { background-color: red; }

      .table td,
      .table th {
        padding: 2px 3px; /* nilai default Bootstrap adalah 12px 15px */
        font-size: 12px;   /* kecilkan teks bila perlu */
      }

      body {
        font-family: 'Times New Roman', Times, serif;
        border-color: black;
        text-transform: uppercase;
        
      }
      
      table {
      border: 1px solid black;
      border-collapse: collapse;
      
    }
      table tr td {
        color: black;
      }

      table tr th {
        color: black;
      }

    td {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
    }
    th {
      border: 1px solid black;
      padding: 8px;
    }
    
    h1 {
      color: black;
    }

  </style>

</head>

<body id="page-top">

  <div id="wrapper">
  <?php
                include 'config.php';
                $filter_bulan = date('m-Y');
                
                if(isset($_GET['filter_bulan_absensi'])){
                  $filter_bulan = $_GET['filter_bulan_absensi'];
                }
                list($bulan, $tahun) = explode('-', $filter_bulan);
                $formatTanggal = DateTime::createFromFormat('m-Y', $filter_bulan);
                $bulanAbsen = $formatTanggal->format('F Y');
                $bulanDoangAbsen = $formatTanggal->format('F');
                $TahunAbsen = $formatTanggal->format('Y');
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

        <div class="container-fluid" >
       
          <div class="d-sm-flex align-items-center justify-content-center mb-4 text-center ">
            <h1 class="h5 mb-0 font-weight-bold">LAPORAN PRESENSI BULAN <?= $bulanDoangAbsen ?> TAHUN <?= $tahun ?>  <br>
            DESA X KECAMATAN Y</h1>
            
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

          <div class="row">
            <div class="col-lg-12" >
              <div class="card shadow mb-4">
              <!-- <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Presensi <?= $bulanAbsen ?></h6>
                <div class="dropdown no-arrow">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Aksi</div>
                    <a class="dropdown-item" href="#"  onclick="printLaporan()">Cetak <i class="fas fa-print"></i></a>
                  </div>
                </div>
              </div> -->
              <div class="card-body"  id="laporan_presensi_bulanan"  >
                  <div class="table-responsive" >
                    <table class="table tb-sm" cellspacing="0">
                      <thead>
                        <tr>
                          <th class="p-2 text-center" rowspan="2">NIPD</th>
                          <th class="p-2 m-0 text-center" rowspan="2">Nama</th>
                          <th class="text-center" colspan="31">Presensi</th>
                          <th class="p-2 m-0 text-center" rowspan="2">Keterangan</th>
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
                      echo "<td class='text-black'>$nipd</td>";
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
                              case 'Libur': echo "<td class='status-Libur'></td>"; break;
                              case 'Hadir Tepat Waktu': echo "<td class='status-Hadir-Tepat-Waktu'>H</td>"; break;
                              case 'Tugas Luar':  echo "<td class='status-Tugas-Luar'>TL</td>"; break;
                              case 'Izin': echo "<td class='status-Izin'>I</td>"; break;
                              case 'Hadir Telat': echo "<td class='status-Hadir-Telat'>H</td>"; break;
                              case 'Tidak Hadir': echo "<td class='status-Tidak-Hadir'></td>"; break;
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
     
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <script src="js/sb-admin-2.min.js"></script>



  <!-- <script src="js/demo/print.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script> -->
  <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
  <script src="js/demo/print.js"></script>
  <script>
    function exportPDF() {
  var element = document.getElementById("laporan_presensi_bulanan"); // ganti dengan elemen yang ingin dicetak

  var opt = {
    margin: 0.5,
    filename: "laporan-presensi-<?= $bulanAbsen ?>.pdf",
    image: { type: "jpeg", quality: 1 },
    html2canvas: { scale: 2, useCORS: true },
    jsPDF: { unit: "in", format: "a4", orientation: "landscape" },
  };

  html2pdf().set(opt).from(element).save();
}
   exportPDF();
   
  </script>
</body>

</html>