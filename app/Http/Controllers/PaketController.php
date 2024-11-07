<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
     public function index()
     {
         $pakets = Paket::paginate(10);
         return view('staff.pages.paket.index', compact('pakets'));
     }
     public function index_admin()
     {
         $pakets = Paket::paginate(10);
         return view('admin.pages.paket.index', compact('pakets'));
     }
// PaketController.php
public function getPaket($id)
{
    $paket = Paket::find($id);

    if ($paket) {
        return response()->json([
            'nm_paket' => $paket->nm_paket, // Pastikan nm_paket dikirim
            'wahana' => $paket->wahana,
            'porsi' => $paket->porsi,
        ]);
    }

    return response()->json(null, 404);
}

    // Method untuk menampilkan form tambah paket
    public function create()
    {
        return view('staff.pages.paket.create');
    }

    // Method untuk menyimpan paket baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'nm_paket' => 'required|string|max:255',
            'wahana' => 'required|string|max:255',
            'porsi' => 'required|integer',
        ]);

        Paket::create([
            'nm_paket' => $request->nm_paket,
            'wahana' => $request->wahana,
            'porsi' => $request->porsi,
        ]);

        return redirect()->route('staff.paket.index')->with('success', 'Paket berhasil ditambahkan');
    }

    // Method untuk menampilkan detail paket
    public function show($id)
    {
        $paket = Paket::findOrFail($id);
        return view('staff.paket.show', compact('paket'));
    }
    public function showadmin($id)
    {
        $paket = Paket::findOrFail($id);
        return view('admin.paket.show', compact('paket'));
    }

    // Method untuk menampilkan form edit paket
    public function edit($id)
    {
        $paket = Paket::findOrFail($id);
        return view('staff.paket.edit', compact('paket'));
    }

    // Method untuk memperbarui data paket
    public function update(Request $request, $id)
    {
        $request->validate([
            'nm_paket' => 'required|string|max:255',
            'wahana' => 'required|string|max:255',
            'porsi' => 'required|integer',
        ]);

        $paket = Paket::findOrFail($id);
        $paket->update([
            'nm_paket' => $request->nm_paket,
            'wahana' => $request->wahana,
            'porsi' => $request->porsi,
        ]);

        return redirect()->route('staff.paket.index')->with('success', 'Paket berhasil diperbarui');
    }

    // Method untuk menghapus paket
    public function destroy($id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();

        return redirect()->route('staff.paket.index')->with('success', 'Paket berhasil dihapus');
    }

    // Method untuk mendapatkan data wahana dan porsi berdasarkan ID paket (untuk AJAX request)
   
}
