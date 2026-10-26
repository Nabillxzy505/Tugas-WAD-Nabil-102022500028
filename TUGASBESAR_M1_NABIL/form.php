<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">

  <h2>Data Mahasiswa</h2>
  <p>Masukkan data mahasiswa :</p>

  <form method="post" action="tambah.php">
    <div class="mb-3">
      <label for="Nama" class="form-label">Nama Mahasiswa:</label>
      <input type="text" class="form-control" id="Nama" name="nama" required>
    </div>

    <div class="mb-3">
      <label for="Nim" class="form-label">NIM:</label>
      <input type="text" class="form-control" id="Nim" name="nim" pattern="\d+" required>
    </div>

    <div class="mb-3">
      <label for="Angkatan" class="form-label">Angkatan:</label>
      <input type="number" class="form-control" id="Angkatan" name="angkatan" min="2000" max="2100" required>
    </div>

    <div class="mb-3">
      <label for="Sks" class="form-label">SKS Lulus:</label>
      <input type="number" class="form-control" id="Sks" name="sks" min="0" max="200" required>
    </div>

    <div class="mb-3">
      <label for="Status" class="form-label">Status Keaktifan:</label>
      <select class="form-select" id="Status" name="status" required>
        <option value="" selected disabled>-- Pilih Status --</option>
        <option value="Aktif">Aktif</option>
        <option value="Non-Aktif">Non-Aktif</option>
        <option value="Cuti">Cuti</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  <p class="mt-3">
    <a href="index.php">Kembali ke Data Mahasiswa</a>
  </p>

</div>
</body>
</html> 