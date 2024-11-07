<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('staff.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'satuan' => 'required',
            'kelompok_produk' => 'required'
        ], [
            'code.required' => 'code wajib diisi',
            'name.required' => 'Nama wajib diisi',
            'satuan.required' => 'satuan wajib diisi',
            'kelompok_produk.required' => 'kelompok_produk wajib dipilih',
        ]);

        $data = [
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'satuan' => $request->input('satuan'),
            'kelompok_produk' => $request->input('kelompok_produk'),
        ];

        Category::create($data);

        return redirect()->route('staff.categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('staff.pages.categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('staff.pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'satuan' => 'required',
            'kelompok_produk' => 'required'
        ], [
            'code.required' => 'code wajib diisi',
            'name.required' => 'Nama wajib diisi',
            'satuan.required' => 'satuan wajib diisi',
            'kelompok_produk.required' => 'kelompok_produk wajib dipilih',
        ]);


        $data = [
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'satuan' => $request->input('satuan'),
            'kelompok_produk' => $request->input('kelompok_produk'),
        ];


        $category = Category::findOrFail($id);

        $category->update($data);

        return redirect()->route('staff.categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('staff.categories.index')->with('success', 'Category deleted successfully');
    }
}
