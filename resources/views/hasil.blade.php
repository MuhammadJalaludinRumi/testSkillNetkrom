<!DOCTYPE html>
<html>
<head>
    <title>Tiket Berhasil Dibeli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow p-4">
        <div class="alert alert-success">
            <h4 class="alert-heading">🎟️ Tiket Berhasil Dibeli!</h4>
            <p><strong>Nama:</strong> {{ session('nama') }}</p>
            <p><strong>Alamat:</strong> {{ session('alamat') }}</p>
            <p><strong>Telepon:</strong> {{ session('telepon') }}</p>
            <p><strong>Email:</strong> {{ session('email') }}</p>
            <p><strong>Jumlah Tiket:</strong> {{ session('jumlah') }}</p>
            <p><strong>Harga per Tiket:</strong> Rp100.000</p>
            <p><strong>Total Bayar:</strong> Rp{{ number_format(session('jumlah') * 100000, 0, ',', '.') }}</p>
            <p><strong>ID Tiket(Harap di simpan atau di screenshot):</strong></p>
            <ul>
                @foreach (session('kode_list') as $kode)
                    <li><span class="badge bg-primary">{{ $kode }}</span></li>
                @endforeach
            </ul>

        </div>

        <form action="{{ route('tiket.reset') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary w-100">Kembali</button>
        </form>
    </div>
</div>

</body>
</html>
