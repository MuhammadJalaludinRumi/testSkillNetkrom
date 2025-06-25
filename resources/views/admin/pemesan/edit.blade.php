<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Pemesan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar seperti halaman beranda -->
<nav class="navbar navbar-light bg-white shadow-sm justify-content-end px-4">
    <a href="{{ route('logout') }}" class="btn btn-outline-danger mt-2">Logout</a>
</nav>

<div class="container py-5">
    <div class="card shadow p-4">
        <h2 class="mb-4 text-center">✏️ Edit Data Pemesan</h2>

        <form method="POST" action="{{ route('admin.pemesan.update', $tiket->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama:</label>
                <input type="text" name="nama" class="form-control" value="{{ $tiket->nama }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat:</label>
                <textarea name="alamat" class="form-control" required>{{ $tiket->alamat }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Telepon:</label>
                <input type="text" name="telepon" class="form-control" value="{{ $tiket->telepon }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ $tiket->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Tiket:</label>
                <input type="number" name="jumlah" class="form-control" value="{{ $tiket->jumlah }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" class="form-select">
                    <option value="dibayar" {{ $tiket->status === 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                    <option value="pending" {{ $tiket->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="batal" {{ $tiket->status === 'batal' ? 'selected' : '' }}>Batal</option>
                </select>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary">💾 Simpan Perubahan</button>
                <a href="{{ route('admin.pemesan.index') }}" class="btn btn-secondary">↩️ Kembali ke Daftar</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
