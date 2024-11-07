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
                <h1>Konversi Storage 1</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Kelola Produk</a></div>
                    {{-- <div class="breadcrumb-item"><a href="#">Ta</a></div> --}}
                    <div class="breadcrumb-item">Konversi Storage 1</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Konversi Storage 1</h2>


                <div class="card">
                    <form action="{{ route('staff.storage_one.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Input Text</h4>
                        </div>
                        <div class="card-body">
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
                                <label>Nomor Produksi</label>
                                <input type="text"
                                    class="form-control @error('nomor_produksi')
                                is-invalid
                            @enderror"
                                    name="nomor_produksi">
                                @error('nomor_produksi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Karyawan</label>
                                <input type="text"
                                    class="form-control @error('karyawan')
                                is-invalid
                            @enderror"
                                    name="karyawan">
                                @error('karyawan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Bagian</label>
                                <input type="text"
                                    class="form-control @error('bagian')
                                is-invalid
                            @enderror"
                                    name="bagian">
                                @error('bagian')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <h4>Input Produksi</h4>
                            <div class="form-group">
                                <label>Produk</label>
                                <select
                                    class="form-control @error('product_input')
                                is-invalid
                            @enderror"
                                    name="product_input" id="product_input">
                                    @error('product_input')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <option value="" @readonly(true)>Pilih Produk</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->name }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" class="form-control @error('satuan') is-invalid @enderror"
                                    name="satuan" id="satuan" readonly>
                                @error('satuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label>Produk</label>
                                <select
                                    class="form-control @error('product_input')
                                is-invalid
                            @enderror"
                                    name="product_input" id="product_input">
                                    @error('product_input')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <option value="" @readonly(true)>Pilih Produk</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->name }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number"
                                    class="form-control @error('qty_input')
                                is-invalid
                            @enderror"
                                    name="qty_input" readonly>
                                @error('qty_input')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" class="form-control @error('satuan_input')is-invalid @enderror"
                                    name="satuan_input" readonly>
                                @error('satuan_input')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" class="form-control @error('harga_input') is-invalid @enderror"
                                    name="harga_input" id="harga_input" readonly>
                                @error('harga_input')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Total</label>
                                <input type="number" class="form-control @error('total_input') is-invalid @enderror"
                                    name="total_input" id="total_input" readonly>
                                @error('total')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <h4>Input Penunjang</h4>
                            <div class="form-group">
                                <label>Biaya Produksi</label>
                                <input type="number"
                                    class="form-control @error('biaya_produksi')
                                is-invalid
                            @enderror"
                                    name="biaya_produksi">
                                @error('biaya_produksi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jumlah Produksi</label>
                                <input type="number"
                                    class="form-control @error('qty_produksi')
                                is-invalid
                            @enderror"
                                    name="qty_produksi">
                                @error('qty_produksi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Satuan Produksi</label>
                                <input type="text" class="form-control @error('satuan_produksi')is-invalid @enderror"
                                    name="satuan_produksi">
                                @error('satuan_produksi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Harga Produksi</label>
                                <input type="number" class="form-control @error('harga_produksi') is-invalid @enderror"
                                    name="harga_produksi" id="harga_produksi">
                                @error('harga_produksi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Total</label>
                                <input type="number" class="form-control @error('total_produksi') is-invalid @enderror"
                                    name="total_produksi" id="total_produksi">
                                @error('total_produksi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="button" id="addForm">Tambah</button>

                                <div id="dynamicFormContainer"></div>
                            </div>
                            <h4>Hasil Konversi</h4>
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
                                <input type="text" class="form-control @error('satuan')is-invalid @enderror"
                                    name="satuan">
                                @error('satuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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
                        <div class="card-footer text-right">
                            <a href="/staff/storage_one" class="btn btn-primary">Kembali</a>
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#product_input').change(function() {
                var productName = $(this).val();

                // alert(productName);

                $.ajax({
                    url: '/get-satuan-product',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: productName // Sesuaikan nama parameter ini dengan yang diterima controller
                    },
                    success: function(response) {
                        $('#satuan_input').val(response.satuan);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            function calculateTotal() {
                var qty = parseFloat($('#qty').val()) || 0;
                var hargaSatuan = parseFloat($('#harga_satuan').val()) || 0;
                var total = qty * hargaSatuan;
                $('#total').val(total);
            }

            $('#qty, #harga_satuan').on('input', function() {
                calculateTotal();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let formIndex = 0;

            $('#addForm').click(function() {
                formIndex++;

                const formTemplate = `
        <div class="dynamic-form" id="form-${formIndex}">
            <h4>Input Produksi</h4>
            <div class="form-group">
                <label>Produk</label>
                <select class="form-control" name="product_input_${formIndex}" id="product_input_${formIndex}">
                    <option value="">Pilih Produk</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->name }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="qty_input_${formIndex}" id="qty_input_${formIndex}" readonly>
            </div>
            <div class="form-group">
                <label>Satuan</label>
                <input type="text" class="form-control" name="satuan_input_${formIndex}" id="satuan_input_${formIndex}" readonly>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" class="form-control" name="harga_input_${formIndex}" id="harga_input_${formIndex}" readonly>
            </div>
            <div class="form-group">
                <label>Total</label>
                <input type="number" class="form-control" name="total_input_${formIndex}" id="total_input_${formIndex}" readonly>
            </div>
            <h4>Input Tambahan</h4>
            <label>Biaya Produksi</label>
            <select class="form-control @error('biaya_produksi') is-invalid @enderror"
                name="biaya_produksi_${formIndex}" id="biaya_produksi_${formIndex}">
                @error('biaya_produksi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <option value="" @readonly(true)>Pilih Biaya</option>
                <option value="Biaya S1">Biaya S1</option>
                <option value="Biaya S2">Biaya S2</option>
                <option value="Biaya Produk Jadi">Biaya Produk Jadi</option>
            </select>
            <div class="form-group">
                <label>Satuan Produksi</label>
                <input type="text" class="form-control" name="satuan_produksi_${formIndex}" id="satuan_produksi_${formIndex}">
            </div>
            <div class="form-group">
                <label>Harga Produksi</label>
                <input type="number" class="form-control" name="harga_produksi_${formIndex}" id="harga_produksi_${formIndex}">
            </div>
            <div class="form-group">
                <label>Total</label>
                <input type="number" class="form-control" name="total_produksi_${formIndex}" id="total_produksi_${formIndex}">
            </div>
            <button type="button" class="btn btn-danger removeForm" data-index="${formIndex}">Delete</button>
            <hr>
        </div>`;

                $('#dynamicFormContainer').append(formTemplate);
            });

            $(document).on('click', '.removeForm', function() {
                const index = $(this).data('index');
                $(`#form-${index}`).remove();
            });

            $(document).ready(function() {
                $('#product_input_${formIndex}').change(function() {
                    var productName = $(this).val();

                    $.ajax({
                        url: '/get-satuan-product',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            name: productName
                        },
                        success: function(response) {
                            $('#satuan_input_${formIndex}').val(response.satuan);
                            $('#harga_input_${formIndex}').val(response.harga);
                            calculateTotal(); // Menghitung total saat harga diperbarui
                        }
                    });
                });

                // $('#qty_input').on('input', function() {
                //     calculateTotal(); // Menghitung total saat qty atau harga diperbarui
                // });

                $('#qty_input_${formIndex}').on('input keyup change', function() {
                    calculateTotal();
                });

                function calculateTotal() {
                    var hargaSatuan = parseFloat($('#harga_input_${formIndex}').val()) || 0;
                    var qty = parseFloat($('#qty_input_${formIndex}').val()) || 0;
                    var total = hargaSatuan * qty;

                    $('#total_input_${formIndex}').val(total);
                }
            });
        });
    </script>
@endpush
