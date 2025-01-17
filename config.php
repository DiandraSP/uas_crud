<?php
// Menyimpan informasi koneksi ke database
$host = "localhost"; // Ganti dengan host jika berbeda
$username = "root";  // Ganti dengan username database Anda
$password = "";      // Ganti dengan password database Anda
$database = "data"; // Ganti dengan nama database Anda

// Membuat koneksi ke MySQL
$con = mysqli_connect($host, $username, $password, $database);

// Mengecek apakah koneksi berhasil
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
