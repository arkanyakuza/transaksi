<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "crmdb"; // Pastikan nama database-nya BENAR dan sama di phpMyAdmin

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
