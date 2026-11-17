<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $mahasiswa->exists ? 'Edit' : 'Tambah' }} Data Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav class="navbar navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('mahasiswa.index') }}">Sistem Informasi TA &amp; Skripsi</a>
    <span class="navbar-text text-white-50">Modul Data Mahasiswa</span>
  </div>
</nav>

<div class="container" style="max-width: 820px;">

  <div class="mb-3">
    <h2 class="page-title">{{ $mahasiswa->exists ? 'Edit' : 'Tambah' }} Data Mahasiswa</h2>
    <p class="page-subtitle">
      {{ $mahasiswa->exists ? 'Ubah data lalu klik Update.' : 'Isi semua kolom lalu klik Simpan.' }}
    </p>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">Data belum bisa disimpan. Periksa kolom yang ditandai merah.</div>
  @endif

  <div class="card card-table p-4">

    <form method="POST"
          action="{{ $mahasiswa->exists ? route('mahasiswa.update', $mahasiswa->id) : route('mahasiswa.store') }}">
      @csrf
      @if ($mahasiswa->exists)
        @method('PUT')
      @endif

      <div class="row g-3">

        <div class="col-md-6">
          <label for="nama" class="form-label">Nama Mahasiswa</label>
          <input type="text" id="nama" name="nama"
                 class="form-control @error('nama') is-invalid @enderror"
                 value="{{ old('nama', $mahasiswa->nama) }}" required>
          @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
          <label for="nim" class="form-label">NIM</label>
          <input type="text" id="nim" name="nim" pattern="\d+"
                 class="form-control @error('nim') is-invalid @enderror"
                 value="{{ old('nim', $mahasiswa->nim) }}" required>
          @error('nim') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
          <label for="angkatan" class="form-label">Angkatan</label>
          <input type="number" id="angkatan" name="angkatan" min="2000" max="2100"
                 class="form-control @error('angkatan') is-invalid @enderror"
                 value="{{ old('angkatan', $mahasiswa->angkatan) }}" required>
          @error('angkatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
          <label for="sks" class="form-label">SKS Lulus</label>
          <input type="number" id="sks" name="sks" min="0" max="200"
                 class="form-control @error('sks') is-invalid @enderror"
                 value="{{ old('sks', $mahasiswa->sks) }}" required>
          @error('sks') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
          <label for="status" class="form-label">Status Keaktifan</label>
          <select id="status" name="status"
                  class="form-select @error('status') is-invalid @enderror" required>
            <option value="" disabled @selected(! old('status', $mahasiswa->status))>-- Pilih Status --</option>
            @foreach (['Aktif', 'Non-Aktif', 'Cuti'] as $s)
              <option value="{{ $s }}" @selected(old('status', $mahasiswa->status) === $s)>{{ $s }}</option>
            @endforeach
          </select>
          @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

      </div>

      <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ $mahasiswa->exists ? 'Update' : 'Simpan' }}</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Batal</a>
      </div>
    </form>

  </div>
</div>

<footer>
  Modul Data Mahasiswa &middot;
</footer>

</body>
</html>