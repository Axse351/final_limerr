<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductResult;
use Illuminate\Http\Request;

class ProductResultController extends Controller
{
    public function index_storage_one()
    {
        $storage_ones = ProductResult::where('status', '=', 'storage_one')->get();;
        return view('staff.pages.storage_one.index', compact('storage_ones'));
    }

    public function index_storage_two()
    {
        $storage_twos = ProductResult::where('status', '=', 'storage_two')->get();;
        return view('staff.pages.storage_two.index', compact('storage_twos'));
    }

    public function index_product_result()
    {
        $product_results = ProductResult::where('status', '=', 'product_result')->get();
        return view('staff.pages.product_result.index', compact('product_results'));
    }

    // public function get_satuan_product(Request $request)
    // {
    //     // $product = Product::where('name', $request->product_input)->first();
    //     // return response()->json(['satuan' => $product->satuan]);

    //     $product = Product::where('name', $request->name)->first();
    //     // dd($product);

    //     if ($product) {
    //         return response()->json(['satuan' => $product->satuan]);
    //     } else {
    //         return response()->json(['satuan' => $product], 404); // Tambahkan error handling jika produk tidak ditemukan
    //     }
    // }

    public function get_satuan_product(Request $request)
    {
        // $category = Category::where('name', $request->name)->first();
        // return response()->json(['satuan' => $category->satuan]);

        $product = Product::where('name', $request->name)->first();
        return response()->json([
            'satuan' => $product->satuan,
            'harga' => $product->harga_satuan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_storage_one()
    {
        $categories = Category::all();

        $products = Product::all();
        return view('staff.pages.storage_one.create', compact('products', 'categories'));
    }

    public function create_storage_two()
    {
        $storage_ones = ProductResult::where('status', '=', 'storage_one')->get();;
        return view('staff.pages.storage_two.create', compact('storage_ones'));
    }

    public function create_product_result()
    {
        $storage_twos = ProductResult::where('status', '=', 'storage_two')->get();;
        return view('staff.pages.product_result.create', compact('storage_twos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_storage_one(Request $request)
    {
        $request->validate([
            'nomor_produksi' => 'required',
            'karyawan' => 'required',
            'bagian' => 'required',
            'date' => 'required',
            'product' => 'required',
            'qty' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'total' => 'required',
            // 'status' => 'required',

        ], [
            'nomor_produksi.required' => 'nomor_produksi wajib diisi',
            'karyawan.required' => 'karyawan wajib diisi',
            'bagian.required' => 'bagian wajib diisi',
            'date.required' => 'date wajib diisi',
            'product.required' => 'product wajib diisi',
            'qty.required' => 'Jumlah wajib diisi',
            'satuan.required' => 'satuan wajib diisi',
            'harga_satuan.required' => 'harga_satuan wajib dipilih',
            'total.required' => 'total wajib dipilih',
            // 'status.required' => 'status wajib dipilih',
        ]);

        $data = [
            'nomor_produksi' => $request->input('nomor_produksi'),
            'karyawan' => $request->input('karyawan'),
            'bagian' => $request->input('bagian'),
            'date' => $request->input('date'),
            'product' => $request->input('product'),
            'qty' => $request->input('qty'),
            'satuan' => $request->input('satuan'),
            'harga_satuan' => $request->input('harga_satuan'),
            'total' => $request->input('total'),
            'status' => 'Storage 1',
        ];

        ProductResult::create($data);

        return redirect()->route('staff.storage_one.index')->with('success', 'Konversi Storage 1 berhasil');
    }

    public function store_storage_two(Request $request)
    {
        $request->validate([
            'nomor_produksi' => 'required',
            'karyawan' => 'required',
            'bagian' => 'required',
            'date' => 'required',
            'product' => 'required',
            'qty' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'total' => 'required',
            // 'status' => 'required',

        ], [
            'nomor_produksi.required' => 'nomor_produksi wajib diisi',
            'karyawan.required' => 'karyawan wajib diisi',
            'bagian.required' => 'bagian wajib diisi',
            'date.required' => 'date wajib diisi',
            'product.required' => 'product wajib diisi',
            'qty.required' => 'Jumlah wajib diisi',
            'satuan.required' => 'satuan wajib diisi',
            'harga_satuan.required' => 'harga_satuan wajib dipilih',
            'total.required' => 'total wajib dipilih',
            // 'status.required' => 'status wajib dipilih',
        ]);

        $data = [
            'nomor_produksi' => $request->input('nomor_produksi'),
            'karyawan' => $request->input('karyawan'),
            'bagian' => $request->input('bagian'),
            'date' => $request->input('date'),
            'product' => $request->input('product'),
            'qty' => $request->input('qty'),
            'satuan' => $request->input('satuan'),
            'harga_satuan' => $request->input('harga_satuan'),
            'total' => $request->input('total'),
            'status' => 'Storage 2',
        ];

        ProductResult::create($data);

        return redirect()->route('staff.storage_two.index')->with('success', 'Konversi Storage 2 berhasil');
    }

    public function store_product_result(Request $request)
    {
        $request->validate([
            'nomor_produksi' => 'required',
            'karyawan' => 'required',
            'bagian' => 'required',
            'date' => 'required',
            'product' => 'required',
            'qty' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'total' => 'required',
            // 'status' => 'required',

        ], [
            'nomor_produksi.required' => 'nomor_produksi wajib diisi',
            'karyawan.required' => 'karyawan wajib diisi',
            'bagian.required' => 'bagian wajib diisi',
            'date.required' => 'date wajib diisi',
            'product.required' => 'product wajib diisi',
            'qty.required' => 'Jumlah wajib diisi',
            'satuan.required' => 'satuan wajib diisi',
            'harga_satuan.required' => 'harga_satuan wajib dipilih',
            'total.required' => 'total wajib dipilih',
            // 'status.required' => 'status wajib dipilih',
        ]);

        $data = [
            'nomor_produksi' => $request->input('nomor_produksi'),
            'karyawan' => $request->input('karyawan'),
            'bagian' => $request->input('bagian'),
            'date' => $request->input('date'),
            'product' => $request->input('product'),
            'qty' => $request->input('qty'),
            'satuan' => $request->input('satuan'),
            'harga_satuan' => $request->input('harga_satuan'),
            'total' => $request->input('total'),
            'status' => 'Produk Jadi',
        ];

        // $data_konversi = [
        //     [
        //         '' => ''
        //     ],
        //     [
        //         '' => ''
        //     ]
        // ];

        for ($i = 0; $i < $request->input('product_input'); $i++) {
            $data_konversi[] = [
                '' => ''
            ];

            $product = Product::findOrFail($request->input('product_input')[$i]);

            $product->qty -= $request->input('qty_input')[$i];

            $product->save();
        }




        ProductResult::create($data);

        return redirect()->route('staff.product_result.index')->with('success', 'Konversi Produk Jadi berhasil');
    }
    /**
     * Display the specified resource.
     */
    public function show(ProductResult $productResult)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductResult $productResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductResult $productResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_storage_one($id)
    {
        $storage_one = ProductResult::find($id);
        $storage_one->delete();
        return redirect()->route('storage_one.index')->with('success', 'storage one deleted successfully');
    }
    
    public function destroy_storage_two($id)
    {
        $storage_two = ProductResult::find($id);
        $storage_two->delete();
        return redirect()->route('storage_two.index')->with('success', 'storage two deleted successfully');
    }

    public function destroy_product_result($id)
    {
        $product_result = ProductResult::find($id);
        $product_result->delete();
        return redirect()->route('product_result.index')->with('success', 'product result deleted successfully');
    }
}
