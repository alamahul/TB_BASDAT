<?php
session_start();
include 'config.php'; // Pastikan file koneksi.php menghubungkan ke database

// Ambil data dari form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Cek apakah input tidak kosong
if (empty($username) || empty($password)) {
    echo "<script>alert('Username dan password wajib diisi!'); window.location='login.php';</script>";
    exit;
}

// Cek di database
$query = $conn->prepare("SELECT * FROM admin WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();

    // Cek kecocokan password
    if ($password == $admin['password']) {
        $_SESSION['username'] = $admin['username'];
        $_SESSION['password'] = $admin['password']; // Jika ada role
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Password salah!'); window.location='login.php';</script>";
    }
} else {
    echo "<script>alert('Username tidak ditemukan!'); window.location='login.php';</script>";
}

// echo "<script> window.location.href = 'index.php' </script>";