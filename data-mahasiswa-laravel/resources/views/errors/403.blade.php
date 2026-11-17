<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>403 - Tidak Punya Akses</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav class="navbar navbar-dark bg-primary mb-5">
  <div class="container">
    <span class="navbar-brand">Sistem Informasi TA &amp; Skripsi</span>
  </div>
</nav>

<div class="container text-center" style="max-width: 520px;">
  <div class="card card-table p-5">
    <h1 class="display-4 fw-bold text-danger">403</h1>
    <p class="mb-1 fw-semibold">Akses ditolak</p>
    <p class="text-muted">{{ $exception->getMessage() ?: 'Anda tidak punya hak akses ke halaman ini.' }}</p>

    @auth
      <p class="small text-muted">
        Masuk sebagai <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->role }})
      </p>
      <div class="d-flex gap-2 justify-content-center">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Kembali</a>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
          @csrf
          <button type="submit" class="btn btn-primary">Keluar</button>
        </form>
      </div>
    @else
      <a href="{{ route('login') }}" class="btn btn-primary">Ke halaman login</a>
    @endauth
  </div>
</div>

</body>
</html>