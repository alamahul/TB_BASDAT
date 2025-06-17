<?php

// var_dump($_POST);die;


include 'config.php'; // pastikan koneksi MySQL aktif


$tanggal = $_POST['tanggal_absensi'];
$filter_bulan = $_POST['filter_bulan_absensi'];
$kode_status = $_POST['multi_presensi']; // default: hadir_tepat_waktu


// Loop untuk pegawai
$jumlah_pegawai = mysqli_query($conn, "SELECT * FROM pegawai")->num_rows;
for ($i = 1; $i <= $jumlah_pegawai; $i++) {
    // Cek apakah checkbox dicentang
    $nipd = $_POST["nipd_pegawai_$i"];
    if (isset($_POST["presensi_pegawai_$i"])) {

        // Cek apakah sudah ada presensi di tanggal tersebut
        $cek = mysqli_query($conn, "SELECT * FROM presensi WHERE nipd = '$nipd' AND tanggal = '$tanggal'");
        if (mysqli_num_rows($cek) == 0) {
            // Simpan data presensi
            mysqli_query($conn, "INSERT INTO presensi (nipd, tanggal, kode_status)
                                    VALUES ('$nipd', '$tanggal', '$kode_status')");
        }
    }else{
        mysqli_query($conn, "INSERT INTO presensi (nipd, tanggal)
                                VALUES ('$nipd', '$tanggal')");
    }
}

header("Location: lihat_detail_absensi.php?tanggal_absensi=$tanggal&filter_bulan_absensi=$filter_bulan");
// echo "Presensi berhasil disimpan untuk tanggal $tanggal.";
?>

