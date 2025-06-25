<!DOCTYPE html>
<html>
<head>
    <title>Admin | Check-In Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar seperti halaman admin -->
<nav class="navbar navbar-light bg-white shadow-sm justify-content-end px-4">
    <a href="{{ route('beranda') }}" class="btn btn-outline-danger mt-2">Logout</a>
</nav>

<div class="container py-5">
    <div class="card shadow p-4">
        <h2 class="mb-4 text-center">🎫 Check-In Tiket Konser</h2>

        {{-- Notifikasi berhasil --}}
        @if(session('success'))
            <div class="alert alert-success text-center">
                <strong>✅ {{ session('success') }}</strong>
            </div>
        @endif
        @if(session('pemesan'))
            @php $p = session('pemesan'); @endphp

            <div class="mt-4 border rounded p-3 bg-white">
                <h5 class="text-center mb-3">📄 Biodata Pemesan</h5>
                <p><strong>Nama:</strong> {{ $p['nama'] }}</p>
                <p><strong>Alamat:</strong> {{ $p['alamat'] }}</p>
                <p><strong>Telepon:</strong> {{ $p['telepon'] }}</p>
                <p><strong>Email:</strong> {{ $p['email'] }}</p>
                <p><strong>Jumlah Tiket:</strong> {{ $p['jumlah'] }}</p>
                <p><strong>Kode Tiket:</strong> <span class="text-primary fw-bold">{{ $p['kode_tiket'] }}</span></p>
            </div>
        @endif

        {{-- Notifikasi gagal --}}
        @if(session('error'))
            <div class="alert alert-danger text-center">
                <strong>❌ {{ session('error') }}</strong>
            </div>
        @endif

        <form method="POST" action="{{ route('checkin.process') }}">
            @csrf
            <div class="mb-3">
                <label for="kode_tiket" class="form-label">Masukkan Kode Tiket:</label>
                <input type="text" name="kode_tiket" id="kode_tiket" class="form-control text-center" placeholder="Contoh: XHY28R92LK" required autofocus>
            </div>

            <button type="submit" class="btn btn-primary w-100">🔍 Proses Check-In</button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('admin.pemesan.index') }}" class="btn btn-outline-secondary">← Kembali ke Daftar Pemesan</a>
        </div>
    </div>
</div>

</body>
</html>
