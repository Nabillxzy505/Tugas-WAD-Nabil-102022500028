<?php
require "koneksi.php";

// Ambil id dari URL (?id=...)
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

// Jika form edit di-submit, proses UPDATE dulu
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $nim      = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $angkatan = mysqli_real_escape_string($koneksi, $_POST['angkatan']);
    $sks      = mysqli_real_escape_string($koneksi, $_POST['sks']);
    $status   = mysqli_real_escape_string($koneksi, $_POST['status']);
    $id       = (int) $_POST['id'];

    $sql = "UPDATE mahasiswa
            SET nim = '$nim', nama = '$nama', angkatan = '$angkatan',
                sks = '$sks', status = '$status'
            WHERE id = $id";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php?pesan=edit");
        exit;
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}

// Ambil data lama untuk ditampilkan di form (READ satu baris)
$id = (int) $id;
$sql = "SELECT * FROM mahasiswa WHERE id = $id";
$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: index.php");    
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">

  <h2>Edit Data Mahasiswa</h2>

  <form method="post" action="edit.php?id=<?= $data['id'] ?>">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">

    <div class="mb-3">
      <label for="Nama" class="form-label">Nama Mahasiswa:</label>
      <input type="text" class="form-control" id="Nama" name="nama"
             value="<?= htmlspecialchars($data['nama']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="Nim" class="form-label">NIM:</label>
      <input type="text" class="form-control" id="Nim" name="nim"
             value="<?= htmlspecialchars($data['nim']) ?>" pattern="\d+" required>
    </div>

    <div class="mb-3">
      <label for="Angkatan" class="form-label">Angkatan:</label>
      <input type="number" class="form-control" id="Angkatan" name="angkatan"
             value="<?= htmlspecialchars($data['angkatan']) ?>" min="2000" max="2100" required>
    </div>

    <div class="mb-3">
      <label for="Sks" class="form-label">SKS Lulus:</label>
      <input type="number" class="form-control" id="Sks" name="sks"
             value="<?= htmlspecialchars($data['sks']) ?>" min="0" max="200" required>
    </div>

    <div class="mb-3">
      <label for="Status" class="form-label">Status Keaktifan:</label>
      <select class="form-select" id="Status" name="status" required>
        <option value="Aktif" <?= $data['status'] === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
        <option value="Non-Aktif" <?= $data['status'] === 'Non-Aktif' ? 'selected' : '' ?>>Non-Aktif</option>
        <option value="Cuti" <?= $data['status'] === 'Cuti' ? 'selected' : '' ?>>Cuti</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>

</div>
</body>
</html>