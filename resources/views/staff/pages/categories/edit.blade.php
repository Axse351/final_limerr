@extends('staff.layouts.app')

@section('title', 'Edit Category')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('staff.content')
    <div class="main-content">
        <section class="section">

            <div class="section-header">
                <h1>Edit Kategori</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Kelola Kategori</a></div>
                    {{-- <div class="breadcrumb-item"><a href="#">Ta</a></div> --}}
                    <div class="breadcrumb-item">Edit Kategori</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Kategori</h2>


                <div class="card">
                    <form action="{{ route('staff.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Input Text</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Kode Produk</label>
                                <input type="text"
                                    class="form-control @error('code')
                                is-invalid
                            @enderror"
                                    name="code" value="{{ $category->code }}">
                                @error('code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="name" value="{{ $category->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Satuan</label>
                                <select
                                    class="form-control @error('satuan')
                                is-invalid
                            @enderror"
                                    name="satuan" id="satuan">
                                    @error('satuan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <option value="" @readonly(true)>Pilih Satuan</option>
                                    <option value="Meter">Meter</option>
                                    <option value="Kodi">Kodi</option>
                                    <option value="Pcs">Pcs</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kelompok Produk</label>
                                <select
                                    class="form-control @error('kelompok_produk')
                                is-invalid
                            @enderror"
                                    name="kelompok_produk" id="kelompok_produk">
                                    @error('kelompok_produk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <option value="" @readonly(true)>Pilih Kelompok Produk</option>
                                    <option value="Bahan Baku">Bahan Baku</option>
                                    <option value="Produk Storage 1">Produk Storage 1</option>
                                    <option value="Produk Storage 2">Produk Storage 2</option>
                                    <option value="Produk Jadi">Produk Jadi</option>
                                </select>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
