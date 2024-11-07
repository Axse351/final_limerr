<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('staff.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getSatuan(Request $request)
    {
        $category = Category::where('name', $request->name)->first();
        return response()->json(['satuan' => $category->satuan]);
    }


    public function create()
    {
        $categories = Category::all();

        return view('staff.pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'pemasok' => 'required',
            'nomor_bukti' => 'required',
            'name' => 'required',
            'qty' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'total' => 'required',
            // 'status' => 'required',

        ], [
            'date.required' => 'date wajib diisi',
            'pemasok.required' => 'pemasok wajib diisi',
            'nomor_bukti.required' => 'nomor_bukti wajib diisi',
            'name.required' => 'name wajib diisi',
            'qty.required' => 'Jumlah wajib diisi',
            'satuan.required' => 'satuan wajib dipilih',
            'harga_satuan.required' => 'harga_satuan wajib dipilih',
            'total.required' => 'total wajib dipilih',
            // 'status.required' => 'status wajib dipilih',
        ]);

        $data = [
            'date' => $request->input('date'),
            'pemasok' => $request->input('pemasok'),
            'nomor_bukti' => $request->input('nomor_bukti'),
            'name' => $request->input('name'),
            'qty' => $request->input('qty'),
            'satuan' => $request->input('satuan'),
            'harga_satuan' => $request->input('harga_satuan'),
            'total' => $request->input('total'),
            'status' => 'Belum Validasi',
        ];

        Product::create($data);

        return redirect()->route('staff.product.index')->with('success', 'Produk created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('staff.pages.product.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::all();

        $product = Product::find($id);
        return view('staff.pages.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'pemasok' => 'required',
            'nomor_bukti' => 'required',
            'name' => 'required',
            'qty' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'total' => 'required',
            // 'status' => 'required',
        ], [
            'date.required' => 'date wajib diisi',
            'pemasok.required' => 'pemasok wajib diisi',
            'nomor_bukti.required' => 'nomor_bukti wajib diisi',
            'name.required' => 'name wajib diisi',
            'qty.required' => 'Jumlah wajib diisi',
            'satuan.required' => 'satuan wajib dipilih',
            'harga_satuan.required' => 'harga_satuan wajib dipilih',
            'total.required' => 'total wajib dipilih',
            // 'status.required' => 'status wajib dipilih',
        ]);


        $data = [
            'date' => $request->input('date'),
            'pemasok' => $request->input('pemasok'),
            'nomor_bukti' => $request->input('nomor_bukti'),
            'name' => $request->input('name'),
            'qty' => $request->input('qty'),
            'satuan' => $request->input('satuan'),
            'harga_satuan' => $request->input('harga_satuan'),
            'total' => $request->input('total'),
            'status' => 'Belum Validasi',
        ];


        $product = Product::findOrFail($id);

        $product->update($data);

        return redirect()->route('staff.product.index')->with('success', 'Produk updated successfully');
    }

    public function update_admin(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'pemasok' => 'required',
            'nomor_bukti' => 'required',
            'name' => 'required',
            'qty' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'total' => 'required',
            // 'status' => 'required',
        ], [
            'date.required' => 'date wajib diisi',
            'pemasok.required' => 'pemasok wajib diisi',
            'nomor_bukti.required' => 'nomor_bukti wajib diisi',
            'name.required' => 'name wajib diisi',
            'qty.required' => 'Jumlah wajib diisi',
            'satuan.required' => 'satuan wajib dipilih',
            'harga_satuan.required' => 'harga_satuan wajib dipilih',
            'total.required' => 'total wajib dipilih',
            // 'status.required' => 'status wajib dipilih',
        ]);


        $data = [
            'date' => $request->input('date'),
            'pemasok' => $request->input('pemasok'),
            'nomor_bukti' => $request->input('nomor_bukti'),
            'name' => $request->input('name'),
            'qty' => $request->input('qty'),
            'satuan' => $request->input('satuan'),
            'harga_satuan' => $request->input('harga_satuan'),
            'total' => $request->input('total'),
            'status' => 'Validasi',
        ];


        $product = Product::findOrFail($id);

        $product->update($data);

        return redirect()->route('admin.product.index')->with('success', 'Produk updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('staff.product.index')->with('success', 'Produk deleted successfully');
    }
}
