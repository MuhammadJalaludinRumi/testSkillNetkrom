<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tiket;

class FormTiketController extends Controller
{
    public function index()
    {
        return view('beranda');
    }

    public function process(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string',
            'alamat'  => 'required|string',
            'telepon' => 'required|string',
            'email'   => 'required|email',
            'jumlah'  => 'required|integer|min:1',
        ]);

        session([
            'nama'    => $request->nama,
            'alamat'  => $request->alamat,
            'telepon' => $request->telepon,
            'email'   => $request->email,
            'jumlah'  => $request->jumlah,
            'step'    => 'payment'
        ]);

        return redirect()->route('beranda');
    }

    public function checkPayment(Request $request)
    {
        $nominal = $request->input('nominal');
        $jumlah = session('jumlah');
        $totalHarga = $jumlah * 100000;

        if ($nominal < $totalHarga) {
            return redirect()->back()->withInput()->with('error', 'Uang yang diinput kurang dari total harga tiket!');
        }

        $kodeList = [];

        for ($i = 0; $i < $jumlah; $i++) {
            $kode = strtoupper(Str::random(10));
            Tiket::create([
                'nama'       => session('nama'),
                'alamat'     => session('alamat'),
                'telepon'    => session('telepon'),
                'email'      => session('email'),
                'jumlah'     => 1,
                'kode_tiket' => $kode,
                'status'     => 'dibayar'
            ]);
            $kodeList[] = $kode;
        }
        if ($nominal < $totalHarga) {
            return redirect()->back()->with('error', 'Uang anda tidak mencukupi');
        }
        session()->put('step', 'result');
        session()->put('kode_list', $kodeList);

        return redirect()->route('tiket.result');
    }

    public function reset(Request $request)
    {
        // Hapus semua data sesi yang digunakan
        session()->forget([
            'nama',
            'alamat',
            'telepon',
            'email',
            'jumlah',
            'step',
            'kode'
        ]);

        return redirect()->route('beranda');
    }

}
