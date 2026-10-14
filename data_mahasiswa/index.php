<?php
require "koneksi.php";

$sql = "select * from mahasiswa order by id desc";
$result = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="container mt-4">

  <h2>Data Mahasiswa</h2>

  <?php if (isset($_GET['pesan'])): ?>
    <div class="alert alert-success mt-2">
      <?php
        if ($_GET['pesan'] === 'tambah') echo "Data berhasil ditambahkan!";
        elseif ($_GET['pesan'] === 'edit') echo "Data berhasil diperbarui!";
        elseif ($_GET['pesan'] === 'hapus') echo "Data berhasil dihapus!";
      ?>
    </div>
  <?php endif; ?>

  <div class="table-responsive mt-3">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">Nama Mahasiswa</th>
          <th scope="col">NIM</th>
          <th scope="col">Angkatan</th>
          <th scope="col">SKS Lulus</th>
          <th scope="col">Status Keaktifan</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['nim']) ?></td>
            <td><?= htmlspecialchars($row['angkatan']) ?></td>
            <td><?= htmlspecialchars($row['sks']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
            <td>
              <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                 onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
            </td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="6" class="text-center text-muted">Belum ada data mahasiswa.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <a href="form.php" class="btn btn-primary mb-3">Tambah Data Mahasiswa</a>

</div>

</body>
</html>