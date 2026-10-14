<?php
require "koneksi.php";

$id = $_GET['id'] ?? null;

if ($id) {
    $id = (int) $id;
    $sql = "DELETE FROM mahasiswa WHERE id = $id";
    mysqli_query($koneksi, $sql);
}

header("Location: index.php?pesan=hapus");
exit;
?>