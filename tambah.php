<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $nim = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $angkatan = mysqli_real_escape_string($koneksi, $_POST['angkatan']);
    $sks = mysqli_real_escape_string($koneksi, $_POST['sks']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    // INSERT: masukkan data ke tabel mahasiswa
    $sql = "insert into mahasiswa (nama, nim, angkatan, sks, status)
            values ('$nama', '$nim', '$angkatan', '$sks', '$status')";
    
    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php?pesan=tambah");
        exit();
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}