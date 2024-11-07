@extends('staff.layouts.app')

@section('title', 'Konversi S1')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('staff.content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Konversi S1</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Kelola Produk</a></div>
                    {{-- <div class="breadcrumb-item"><a href="#">Ta</a></div> --}}
                    <div class="breadcrumb-item">Konversi S1</div>
                </div>
            </div>

            <div class="section-body">
                <form action="{{ route('staff.storage_one.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h5>Produksi S1</h5>
                            <hr>
                            <div class="row">
                                <div class="col-6">
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
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nomor Produksi</label>
                                        <input type="text"
                                            class="form-control @error('nomor_produksi') is-invalid @enderror"
                                            name="nomor_produksi">
                                        @error('nomor_produksi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama Karyawan</label>
                                        <input type="text" class="form-control @error('karyawan') is-invalid @enderror"
                                            name="karyawan">
                                        @error('karyawan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Bagian</label>
                                        <input type="text" class="form-control @error('bagian') is-invalid @enderror"
                                            name="bagian">
                                        @error('bagian')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card_data">

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-primary" type="button" id="addForm">Tambah Data</button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5>Hasil Konversi</h5>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama Produk</label>
                                        <input type="text"
                                            class="form-control @error('product')
                                is-invalid
                            @enderror"
                                            name="product">
                                        @error('product')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
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
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <input type="text" class="form-control @error('satuan')is-invalid @enderror"
                                            name="satuan">
                                        @error('satuan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                            name="harga" id="harga">
                                        @error('harga')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="number" class="form-control @error('total') is-invalid @enderror"
                                            name="total" id="total">
                                        @error('total')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <a href="/staff/storage_one" class="btn btn-warning">Kembali</a>
                            <button class="btn btn-success" type="button" id="addForm">Konversi</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>



@endsection

@push('scripts')
    <script>
        // pertama load manggilfungsi addFOrm unuk menyediakan form awal
        $(document).ready(() => {
            addForm();
        })

        $('#addForm').on('click', () => {
            addForm();
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- <script>
        $(document).on('change click', '.product_input', function() {

            let parentIndex = $(this).closest('.card');

            console.log(parentIndex.find('.satuan_input').val());

            // var selectedOption = $(`select option:selected`);

            // // Mengambil nilai atribut data-harga
            var harga = parentIndex.find('select').find('option:selected').data('harga');
            var satuan = parentIndex.find('select').find('option:selected').data('satuan');

            parentIndex.find('.satuan_input').val(satuan);
            parentIndex.find('.harga_input').val(harga);
            parentIndex.find('.satuan_produksi').val(satuan);

            let total = parseFloat(parentIndex.find('.harga_input').val()) * parseFloat(harga);

            console.log(total);
            parentIndex.find('.total_input').val(total);

        });
    </script> --}}


    <script>
        function addForm() {
            let cardIndex = $('.card_data .card').length + 1;

            // <h5 class="modal-title p-0">ID. ${cardIndex}</h5>

            // console.log(cardIndex);?
            const formTemplate = `<div class="card mb-3" data-id="${cardIndex}" data-row="row_${cardIndex}">
                <div class="modal-header py-3 bg-light">
                    <button type="button" class="close removeForm" >
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="card-body">
                <div class="dynamic-form" id="form-1">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Input Produksi</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Produk</label>
                                        <select class="form-control product_input @error('product_input') is-invalid @enderror"
                                            name="product_input[]" id="product_input_${cardIndex}">
                                            @error('product_input')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <option value="" @readonly(true)>Pilih Produk</option>
                                            @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-harga="{{ $product->harga_satuan }}" data-qty="{{ $product->qty }}" data-satuan="{{ $product->satuan }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="number" class="form-control qty_input" name="qty_input[]" value="0" min="0" id="total_input_${cardIndex}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <input type="text" class="form-control satuan_input" name="satuan_input" value="-" id="satuan_input_${cardIndex}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" class="form-control harga_input" name="harga_input" value="0" min="0" id="harga_input_${cardIndex}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="hidden" class="form-control total_input" name="total_input" value="0" min="0"  id="total_input_${cardIndex}" readonly>
                                        <input type="text" class="form-control total_input_show" name="total_input_show" value="0" min="0"  id="total_input_show_${cardIndex}" readonly>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <h4>Input Penunjang</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Biaya Produksi</label>
                                        <select class="form-control @error('biaya_produksi') is-invalid @enderror"
                                        name="biaya_produksi" id="biaya_produksi" >
                                        <option value="" selected disabled>Pilih Biaya</option>
                                        <option value="Biaya S1">Biaya S1</option>
                                        <option value="Biaya S2">Biaya S2</option>
                                        <option value="Biaya Produk Jadi">Biaya Produk Jadi</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Satuan Produksi</label>
                                        <input type="text" class="form-control satuan_produksi" name="satuan_produksi" value="-" id="satuan_produksi_${cardIndex}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Harga Produksi</label>
                                        <input type="number" class="form-control harga_produksi" name="harga_produksi" value="0" min="0" id="harga_produksi_${cardIndex}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="hidden" class="form-control total_produksi" name="total_produksi" value="0" min="0" id="total_produksi_${cardIndex}">
                                        <input type="text" class="form-control total_produksi_show" name="total_produksi_show" value="0" min="0" id="total_produksi_show_${cardIndex}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;

            // append data
            $('.card_data').append(formTemplate);
        }

        $(document).on('click', '.removeForm', function() {
            let index = $(this).closest('.card')
            index.remove();


        });
    </script>

    <script>
        function hitungTotal(parentIndex) {
            let qty = parseFloat(parentIndex.find('.qty_input').val()) || 0;
            let harga = parseFloat(parentIndex.find('.harga_input').val()) || 0;
            let total = qty * harga;

            parentIndex.find('.total_input').val(total);
            parentIndex.find('.total_input_show').val(formatRupiah(total));
        }

        $(document).on('change click', '.product_input', function() {
            let parentIndex = $(this).closest('.card');


            var harga = parentIndex.find('select').find('option:selected').data('harga');
            var satuan = parentIndex.find('select').find('option:selected').data('satuan');
            var qty = parentIndex.find('select').find('option:selected').data('qty');

            parentIndex.find('.satuan_input').val(satuan);
            parentIndex.find('.harga_input').val(harga);
            parentIndex.find('.satuan_produksi').val(satuan);
            parentIndex.find('.qty_input').attr('max', qty);

            // Hitung total
            hitungTotal(parentIndex);
        });

        $(document).on('change input keyup click', '.qty_input', function() {
            let parentIndex = $(this).closest('.card');

            // Hitung total
            hitungTotal(parentIndex);
        });

        $(document).on('change input keyup click', '.harga_produksi', function() {
            let parentIndex = $(this).closest('.card');

            let total = parseFloat(parentIndex.find('.total_input').val()) || 0;

            let totalAkhir = parseFloat($(this).val()) + total;

            // append data
            parentIndex.find('.total_produksi').val(totalAkhir);
            parentIndex.find('.total_produksi_show').val(formatRupiah(totalAkhir));
        });

        function formatRupiah(value, locale = 'id-ID') {
            const formatter = new Intl.NumberFormat(locale, {
                style: 'currency',
                currency: 'IDR',
                currencyDisplay: 'symbol',
                minimumFractionDigits: 2, // Menentukan jumlah digit desimal
                maximumFractionDigits: 2
            });
            return formatter.format(value);
        }
    </script>
@endpush
