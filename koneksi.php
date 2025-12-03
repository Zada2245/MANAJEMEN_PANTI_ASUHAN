<?php
$host = "localhost";
$user = "root";
$pass = ""; // Password default Laragon kosong
$db   = "db_panti";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>