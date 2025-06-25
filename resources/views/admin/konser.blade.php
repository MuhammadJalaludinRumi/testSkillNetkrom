@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5 bg-light">
                    <h2 class="text-center mb-4">🎶 Panel Admin Konser 🎉</h2>

                    <p class="text-center text-muted">
                        Halo Admin! Dari halaman ini, Anda dapat mengelola seluruh data pemesan tiket konser.
                        Pastikan semua data telah diperiksa sebelum konser dimulai!
                    </p>

                    <div class="text-center mt-4">
                        <a href="{{ route('admin.pemesan.index') }}" class="btn btn-lg btn-outline-dark px-5 py-2">
                            👥 Lihat Daftar Pemesan
                        </a>
                    </div>

                    <div class="mt-5 text-center text-muted small">
                        <em>"Musik adalah suara dari jiwa yang bahagia." 🎧</em>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
