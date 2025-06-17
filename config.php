<?php
$host = "localhost";      // atau 127.0.0.1
$user = "root";           // user MySQL kamu
$password = "";           // password MySQL (kosong jika default XAMPP)
$dbname = "db_sipedes"; // ganti dengan nama database kamu

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// echo "Koneksi berhasil!";
?>