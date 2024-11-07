
<!-- contoh untuk input field -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Transaksi</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Buat Transaksi Baru</h1>
    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <div>
            <label for="nm_konsumen">Nama Konsumen:</label>
            <input type="text" name="nm_konsumen" id="nm_konsumen">
        </div>
        <div>
            <label for="nohp">No HP:</label>
            <input type="text" name="nohp" id="nohp">
        </div>
        <div>
            <label for="nm_paket">Nama Paket:</label>
            <select name="nm_paket" id="nm_paket">
                <option value="">Pilih Paket</option>
                @foreach($paket as $item)
                    <option value="{{ $item->id }}">{{ $item->nm_paket }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="wahana">Wahana:</label>
            <input type="text" name="wahana" id="wahana" readonly>
        </div>
        <div>
            <label for="porsi">Porsi:</label>
            <input type="number" name="porsi" id="porsi" readonly>
        </div>
        <button type="submit">Simpan</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#nm_paket').change(function() {
                var paketId = $(this).val();
                if (paketId) {
                    $.ajax({
                        url: '/get-paket/' + paketId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data) {
                                $('#wahana').val(data.wahana);
                                $('#porsi').val(data.porsi);
                            } else {
                                $('#wahana').val('');
                                $('#porsi').val('');
                            }
                        }
                    });
                } else {
                    $('#wahana').val('');
                    $('#porsi').val('');
                }
            });
        });
    </script>
</body>
</html>


@extends('staff.layouts.app')

@section('title', 'Tambah Transaksi')

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
                <h1>Tambah Transaksi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Kelola Transaksi</a></div>
                    {{-- <div class="breadcrumb-item"><a href="#">Ta</a></div> --}}
                    <div class="breadcrumb-item">transaksi</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Transaksi</h2>


                <div class="card">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>ISI DENGAN KETENTUAN</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Konsumen</label>
                                <input type="text"
                                    class="form-control @error('nm_konsumen')
                                is-invalid
                            @enderror"
                                    name="nm_konsumen">
                                @error('nm_konsumen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nomor Handphone</label>
                                <input type="text"
                                    class="form-control @error('nohp')
                                is-invalid
                            @enderror"
                                    name="nohp">
                                @error('nohp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nm_paket">PILIH PAKET:</label>
                                <select
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="nm_paket" id="nm_paket">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <option value="" @readonly(true)>Pilih Paket</option>
                                    @foreach($paket as $item)
                                    <option value="{{ $item->id }}">{{ $item->nm_paket }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="wahana">Wahana:</label>
                                <input type="text" class="form-control @error('wahana') is-invalid @enderror"
                                       name="wahana" id="wahana" readonly>
                                @error('wahana')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="porsi">Porsi:</label>
                                <input type="text" class="form-control @error('porsi') is-invalid @enderror"
                                       name="porsi" id="porsi" readonly>
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
     <script>
        $(document).ready(function() {
    $('#nm_paket').change(function() {
        var paketId = $(this).val();
        if (paketId) {
            $.ajax({
                    url: '/get-paket/' + paketId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: productName
                    },
                    success: function(response) {
                        $('#satuan').val(response.satuan);
                    }
                });
        } 
    });
});

    </script>
@endpush


