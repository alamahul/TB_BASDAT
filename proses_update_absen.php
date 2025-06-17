<?php

// var_dump($_POST);die;


include 'config.php'; // pastikan koneksi MySQL aktif

$filter_bulan = $_POST['filter_bulan_absensi'];
$tanggal = $_POST['tanggal_absensi'];
// var_dump($tanggal);die;
$kode_status = $_POST['multi_presensi']; // default: hadir_tepat_waktu
// var_dump($kode_status);die;

// var_dump($_POST);die;
// Loop untuk pegawai
$jumlah_pegawai = mysqli_query($conn, "SELECT * FROM pegawai")->num_rows;
for ($i = 1; $i <= $jumlah_pegawai; $i++) {
    // Cek apakah checkbox dicentang
    $nipd = $_POST["nipd_pegawai_$i"];
    echo $nipd;
    if (isset($_POST["presensi_pegawai_$i"])) {

        // Cek apakah sudah ada presensi di tanggal tersebut
        $cek = mysqli_query($conn, "SELECT * FROM presensi WHERE nipd = '$nipd' AND tanggal = '$tanggal'");
        if (mysqli_num_rows($cek) == 1) {
            // Simpan data presensi
            mysqli_query($conn, "UPDATE presensi SET kode_status = '$kode_status' WHERE nipd = '$nipd' AND tanggal = '$tanggal'");
        }
    }
}
// die;
header("Location: lihat_detail_absensi.php?tanggal_absensi=$tanggal&filter_bulan_absensi=$filter_bulan");
// echo "Presensi berhasil disimpan untuk tanggal $tanggal.";
?>

