@extends('staff.layouts.app')

@section('title', 'Tambah Produk')

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
                <h1>Tambah Riwayat Barang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Kelola Riwayat</a></div>
                    {{-- <div class="breadcrumb-item"><a href="#">Ta</a></div> --}}
                    <div class="breadcrumb-item">Tambah Produk</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Produk</h2>


                <div class="card">
                    <form action="{{ route('staff.history.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Input Text</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nomor Bukti</label>
                                <input type="text"
                                    class="form-control @error('nomor_bukti')
                                is-invalid
                            @enderror"
                                    name="nomor_bukti">
                                @error('nomor_bukti')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Gudang</label>
                                <input type="text"
                                    class="form-control @error('gudang')
                                is-invalid
                            @enderror"
                                    name="gudang">
                                @error('gudang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Pemasok</label>
                                <input type="text"
                                    class="form-control @error('pemasok')
                                is-invalid
                            @enderror"
                                    name="pemasok">
                                @error('pemasok')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Produk</label>
                                <select
                                    class="form-control @error('product_id')
                                is-invalid
                            @enderror"
                                    name="product_id" id="product_id">
                                    @error('product_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <option value="" @readonly(true)>Pilih Produk</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number"
                                    class="form-control @error('qty')
                                is-invalid
                            @enderror"
                                    name="qty">
                                @error('qty')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text"
                                    class="form-control @error('satuan')
                                is-invalid
                            @enderror"
                                    name="satuan">
                                @error('satuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="number"
                                    class="form-control @error('harga_satuan')
                                is-invalid
                            @enderror"
                                    name="harga_satuan">
                                @error('harga_satuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Total</label>
                                <input type="number"
                                    class="form-control @error('total')
                                is-invalid
                            @enderror"
                                    name="total">
                                @error('total')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date"
                                    class="form-control @error('date')
                                is-invalid
                            @enderror"
                                    name="date">
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Waktu</label>
                                <input type="time"
                                    class="form-control @error('time')
                                is-invalid
                            @enderror"
                                    name="time">
                                @error('time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
