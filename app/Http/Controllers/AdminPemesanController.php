<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;

class AdminPemesanController extends Controller
{

    public function index()
    {
        $data = \App\Models\Tiket::latest()->get();
        return view('admin.pemesan.index', compact('data'));
    }


    public function edit($id)
    {
        $tiket = Tiket::findOrFail($id);
        return view('admin.pemesan.edit', compact('tiket'));
    }

    public function update(Request $request, $id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->update($request->only(['nama', 'alamat', 'telepon', 'email', 'jumlah', 'status']));
        return redirect()->route('admin.pemesan.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->delete();
        return redirect()->route('admin.pemesan.index')->with('success', 'Data berhasil dihapus.');
    }
}
