<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "data_mahasiswa";

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());

}
?>