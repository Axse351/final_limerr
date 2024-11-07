@extends('staff.layouts.app')

@section('title', 'Edit Produk')

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
            <h1>Histori Transaksi</h1>
        </div>
        <div class="section-body">
            <form method="GET" action="{{ route('histories.index') }}">
                <div class="form-group">
                    <label for="barcode">Cari berdasarkan Barcode:</label>
                    <input type="text" name="barcode" id="barcode" class="form-control" value="{{ request('barcode') }}">
                    <button type="submit" class="btn btn-primary mt-2">Cari</button>
                </div>
            </form>

            <div class="row">
                <div class="col-12">
                    @include('staff.layouts.alert')
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Daftar Histori</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Konsumen</th>
                                        <th>Nama Paket</th>
                                        <th>Wahana</th>
                                        <th>Porsi</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($histories as $history)
                                        <tr>
                                            <td>{{ $history->nama_konsumen }}</td>
                                            <td>{{ $history->nama_paket }}</td>
                                            <td>{{ $history->wahana }}</td>
                                            <td>{{ $history->porsi }}</td>
                                            <td>{{ $history->tanggal }}</td>
                                            <td>{{ $history->jam }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination Links -->
                            {{ $histories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
@endpush
