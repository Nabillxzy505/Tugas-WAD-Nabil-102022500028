<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@php
  // Hak akses di tampilan: hanya admin yang melihat tombol tambah/edit/hapus
  $isAdmin = auth()->user()->role === 'admin';
@endphp

<nav class="navbar navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('mahasiswa.index') }}">Sistem Informasi TA &amp; Skripsi</a>

    <div class="d-flex align-items-center gap-3">
      <span class="navbar-text text-white">
        {{ auth()->user()->name }}
        <span class="badge text-bg-light text-uppercase">{{ auth()->user()->role }}</span>
      </span>
      <form action="{{ route('logout') }}" method="POST" class="m-0">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-light">Keluar</button>
      </form>
    </div>
  </div>
</nav>

<div class="container">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h2 class="page-title">Data Mahasiswa</h2>
      <p class="page-subtitle">Total {{ $mahasiswa->count() }} mahasiswa peserta TA/Skripsi</p>
    </div>

    @if ($isAdmin)
      <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">+ Tambah Data</a>
    @endif
  </div>

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
  @endif

  <div class="card card-table">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th scope="col">Nama Mahasiswa</th>
            <th scope="col">NIM</th>
            <th scope="col">Angkatan</th>
            <th scope="col">SKS Lulus</th>
            <th scope="col">Status Keaktifan</th>
            @if ($isAdmin)
              <th scope="col" class="text-end">Aksi</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @forelse ($mahasiswa as $m)
            @php
              $warna = ['Aktif' => 'success', 'Cuti' => 'warning', 'Non-Aktif' => 'danger'][$m->status] ?? 'secondary';
            @endphp
            <tr>
              <td class="fw-semibold">{{ $m->nama }}</td>
              <td>{{ $m->nim }}</td>
              <td>{{ $m->angkatan }}</td>
              <td>{{ $m->sks }}</td>
              <td><span class="badge badge-status text-bg-{{ $warna }}">{{ $m->status }}</span></td>

              @if ($isAdmin)
                <td class="text-end">
                  <a href="{{ route('mahasiswa.edit', $m->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>

                  <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Yakin hapus data {{ $m->nama }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                  </form>
                </td>
              @endif
            </tr>
          @empty
            <tr>
              <td colspan="{{ $isAdmin ? 6 : 5 }}" class="text-center text-muted py-5">
                Belum ada data mahasiswa.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>

<footer>
  Modul Data Mahasiswa &middot; Pengembangan Aplikasi Web
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>