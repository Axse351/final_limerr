<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Product;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histories = History::paginate(10);
        return view('staff.pages.history.index', compact('histories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('staff.pages.history.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_bukti' => 'required',
            'gudang' => 'required',
            'pemasok' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'total' => 'required',
            'date' => 'required',
            'time' => 'required',
        ], [
            'nomor_bukti.required' => 'Nomor Bukti wajib diisi',
            'gudang.required' => 'Gudang wajib diisi',
            'pemasok.required' => 'Pemasok wajib diisi',
            'product_id.required' => 'Produk wajib diisi',
            'qty.required' => 'Jumlah wajib dipilih',
            'satuan.required' => 'satuan wajib dipilih',
            'harga_satuan.required' => 'harga satuan wajib dipilih',
            'total.required' => 'total wajib dipilih',
            'date.required' => 'tanggal wajib dipilih',
            'time.required' => 'waktu wajib dipilih',
        ]);

        $data = [
            'nomor_bukti' => $request->input('nomor_bukti'),
            'gudang' => $request->input('gudang'),
            'pemasok' => $request->input('pemasok'),
            'product_id' => $request->input('product_id'),
            'qty' => $request->input('qty'),
            'satuan' => $request->input('satuan'),
            'harga_satuan' => $request->input('harga_satuan'),
            'total' => $request->input('total'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
        ];

        History::create($data);

        return redirect()->route('staff.history.index')->with('success', 'History created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(History $history)
    {
        return view('staff.pages.history.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $history = History::find($id);
        $products = Product::all();

        return view('staff.pages.history.edit', compact('history', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_bukti' => 'required',
            'gudang' => 'required',
            'pemasok' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'total' => 'required',
            'date' => 'required',
            'time' => 'required',
        ], [
            'nomor_bukti.required' => 'Nomor Bukti wajib diisi',
            'gudang.required' => 'Gudang wajib diisi',
            'pemasok.required' => 'Pemasok wajib diisi',
            'product_id.required' => 'Produk wajib diisi',
            'qty.required' => 'Jumlah wajib dipilih',
            'satuan.required' => 'satuan wajib dipilih',
            'harga_satuan.required' => 'harga satuan wajib dipilih',
            'total.required' => 'total wajib dipilih',
            'date.required' => 'tanggal wajib dipilih',
            'time.required' => 'waktu wajib dipilih',
        ]);


        $data = [
            'nomor_bukti' => $request->input('nomor_bukti'),
            'gudang' => $request->input('gudang'),
            'pemasok' => $request->input('pemasok'),
            'product_id' => $request->input('product_id'),
            'qty' => $request->input('qty'),
            'satuan' => $request->input('satuan'),
            'harga_satuan' => $request->input('harga_satuan'),
            'total' => $request->input('total'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
        ];


        $history = History::findOrFail($id);

        $history->update($data);

        return redirect()->route('staff.history.index')->with('success', 'history updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $history = History::find($id);
        $history->delete();
        return redirect()->route('staff.history.index')->with('success', 'history deleted successfully');
    }
}
