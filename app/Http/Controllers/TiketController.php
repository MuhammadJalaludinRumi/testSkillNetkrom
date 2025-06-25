<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class TiketController extends Controller
{
    public function beranda()
    {
        return view('beranda');
    }

    public function check_payment(Request $request)
    {
        $nominal = $request->input('nominal');
        $total = session('jumlah') * 100000;

        if ($nominal == $total) {
            $kode = strtoupper(Str::random(10));

            // Debug log
            Log::info('Akan menyimpan tiket', [
                'nama' => session('nama'),
                'alamat' => session('alamat'),
                'telepon' => session('telepon'),
                'email' => session('email'),
                'jumlah' => session('jumlah'),
                'kode' => $kode
            ]);

            $tiket = Tiket::create([
                'nama'       => session('nama'),
                'alamat'     => session('alamat'),
                'telepon'    => session('telepon'),
                'email'      => session('email'),
                'jumlah'     => session('jumlah'),
                'kode_tiket' => $kode,
                'status'     => 'dibayar'
            ]);

            Log::info('Tiket berhasil disimpan', ['id' => $tiket->id]);

            session()->put('step', 'result');
            session()->put('kode', $kode);
        } else {
            return back()->with('error', 'Jumlah uang tidak sesuai.');
        }

        return redirect('/');
    }
    public function showCheckinForm()
    {
        return view('admin/checkin');
    }

    public function processCheckin(Request $request)
    {
        $kode = $request->input('kode_tiket');
        $tiket = Tiket::where('kode_tiket', $kode)->first();

        if (!$tiket) {
            return redirect()->back()->with('error', 'Kode tiket tidak ditemukan');
        }

        if ($tiket->status === 'checked_in') {
            return redirect()->back()->with('error', '❌ Kode hangus. Tiket sudah digunakan.');
        }

        // Ubah status ke checked_in
        $tiket->status = 'checked_in';
        $tiket->save();

        return redirect()->back()->with([
            'success' => 'Check-In Berhasil',
            'pemesan' => $tiket
        ]);
    }



}
