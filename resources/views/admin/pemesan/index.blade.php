<!DOCTYPE html>
<html>
<head>
    <title>Admin | Daftar Pemesan Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar dengan tombol Check-In di kiri dan Logout di kanan -->
<nav class="navbar navbar-light bg-white shadow-sm px-4 d-flex justify-content-between">
    <a href="{{ route('checkin.form') }}" class="btn btn-outline-primary mt-2">🔄 Check-In</a>
    <a href="{{ route('beranda') }}" class="btn btn-outline-danger mt-2">Logout</a>
</nav>


<div class="container py-5">
    <div class="card shadow p-4">
        <h2 class="mb-4 text-center">📋 Daftar Pemesan Tiket</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Jumlah</th>
                        <th>Kode Tiket</th>
                        <th>Status</th>

                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $tiket)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tiket->nama }}</td>
                            <td>{{ $tiket->alamat }}</td>
                            <td>{{ $tiket->telepon }}</td>
                            <td>{{ $tiket->email }}</td>
                            <td>{{ $tiket->jumlah }}</td>
                            <td><strong class="text-primary">{{ $tiket->kode_tiket }}</strong></td>
                            <td>
                                @if($tiket->status == 'checked_in')
                                    <span class="badge bg-primary">Checked-In</span>
                                @elseif($tiket->status == 'dibayar')
                                    <span class="badge bg-success">Dibayar</span>
                                @elseif($tiket->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @else
                                    <span class="badge bg-danger">Batal</span>
                                @endif
                            </td>

                         <td>{{ $tiket->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.pemesan.edit', $tiket->id) }}" class="btn btn-sm btn-warning mb-1">✏️ Edit</a>
                                <form action="{{ route('admin.pemesan.destroy', $tiket->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-muted text-center">Belum ada pemesanan tiket.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
