    <!DOCTYPE html>
    <html>
    <head>
        <title>Beranda Pemesanan Tiket</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
    <nav class="navbar navbar-light bg-white shadow-sm justify-content-end px-4">
        <a href="{{ route('admin.login.form') }}" class="btn btn-outline-dark mt-2">Login Admin</a>
    </nav>

    <div class="container py-5">
        <div class="card shadow p-4">
            <h2 class="mb-4 text-center">Pemesanan Tiket Konser</h2>
            <hr class="my-5">

            <div class="text-center">
                <h2 class="text-dark mt-4">Konser Agen X</h2>
            </div>
           @if(session('step') === 'payment')

                <form method="POST" action="{{ route('tiket.check_payment') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama:</label>
                        <input type="text" class="form-control" value="{{ session('nama') }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat:</label>
                        <input type="text" class="form-control" value="{{ session('alamat') }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No. Telepon:</label>
                        <input type="text" class="form-control" value="{{ session('telepon') }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" value="{{ session('email') }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah Tiket:</label>
                        <input type="number" class="form-control" value="{{ session('jumlah') }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total Harga:</label>
                        <input type="text" class="form-control" value="Rp{{ number_format(session('jumlah') * 100000, 0, ',', '.') }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran:</label>
                        <input type="text" class="form-control" value="BankPayment" disabled>
                    </div>
                    <div class="text-center mb-4">
                        <p class="text-muted">Silakan scan QR berikut untuk membayar</p>
                        <div class="d-flex justify-content-center">
                            {!! QrCode::size(150)->generate('Pembayaran Tiket - ' . session('jumlah') . ' Tiket - Total Rp' . (session('jumlah') * 100000)) !!}
                        </div>
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Masukkan Jumlah Uang:</label>
                        <input type="number" name="nominal" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Bayar</button>
                </form>


            @else
                <form method="POST" action="{{ route('tiket.process') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama:</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat:</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No. Telepon:</label>
                        <input type="text" name="telepon" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah Tiket:</label>
                        <input type="number" name="jumlah" class="form-control" required min="1">
                    </div>

                    <button type="submit" class="btn btn-success w-100">Lanjut Pembayaran</button>
                </form>
            @endif
        </div>


    </div>

    </body>
    </html>
