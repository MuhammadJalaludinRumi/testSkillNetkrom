<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konser;

class AdminController extends Controller
{
    // Tampilkan daftar konser
    public function index()
    {
        $konser = Konser::all();
        return view('admin.konser', compact('konser'));
    }

    // Form tambah konser
    public function create()
    {
        return view('admin.konser_create');
    }

    // Simpan konser baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string',
            'harga' => 'required|integer|min:0',
        ]);

        Konser::create([
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.konser.index')->with('success', 'Konser berhasil ditambahkan');
    }

    // Form Check-in tiket (petugas input kode tiket)
    public function checkinForm()
    {
        return view('admin.checkin');
    }
}
