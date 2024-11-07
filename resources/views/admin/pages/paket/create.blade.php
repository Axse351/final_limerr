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
                <h1>Tambah Data Paket</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Kelola Paket</a></div>
                    {{-- <div class="breadcrumb-item"><a href="#">Ta</a></div> --}}
                    <div class="breadcrumb-item">Tambah Paket</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Paket</h2>


                <div class="card">
                    <form action="{{ route('staff.paket.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Input Text</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Paket</label>
                                <input type="text"
                                    class="form-control @error('nm_paket')
                                is-invalid
                            @enderror"
                                    name="nm_paket">
                                @error('nm_paket')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Wahana</label>
                                <input type="text"
                                    class="form-control @error('wahana')
                                is-invalid
                            @enderror"
                                    name="wahana">
                                @error('wahana')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Porsi</label>
                                <input type="text"
                                    class="form-control @error('porsi')
                                is-invalid
                            @enderror"
                                    name="porsi">
                                @error('porsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="/staff/product" class="btn btn-primary">Kembali</a>
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
            $('#name').change(function() {
                var productName = $(this).val();

                // alert(productName);

                $.ajax({
                    url: '/get-satuan',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: productName
                    },
                    success: function(response) {
                        $('#satuan').val(response.satuan);
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
@endpush
