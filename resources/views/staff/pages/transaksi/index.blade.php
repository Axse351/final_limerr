@extends('staff.layouts.app')

@section('title', 'transaksi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <style>
        .pagination {
            font-size: 0.875rem; /* Adjust the font size */
        }
        .pagination .page-link {
            padding: 0.25rem 0.5rem; /* Adjust the padding to reduce size */
        }
    </style>
@endpush

@section('staff.content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Transaksi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Riwayat</a></div>
                    <div class="breadcrumb-item">Riwayat</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('staff.layouts.alert')
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Data Transaksi</h4>
                            </div>
                            <div class="card-body">

                                <div class="float-ledt">
                                    <a href="{{ route('staff.transaksi.create') }}" class="btn btn-primary">Tambah Data Pemesan</a>
                                </div>

                                <div class="float-right">
                                    <form method="GET" action="{{ route('staff.transaksi.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-4"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th class="text-center">Nama Konsumen</th>
                                            <th class="text-center">Nomor Handphone</th>
                                            <th class="text-center">Nama Paket</th>
                                            <th class="text-center">Wahana</th>
                                            <th class="text-center">Porsi</th>
                                            <th class="text-center">Kode Unik</th>
                                            <th class="text-center">Barcode</th> <!-- Kolom baru untuk barcode -->
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        @foreach ($transaksis as $transaksi)
                                            <tr>
                                                <td class="text-center">{{ $transaksi->nm_konsumen }}</td>
                                                <td class="text-center">{{ $transaksi->nohp }}</td>
                                                <td class="text-center">{{ $transaksi->paket->nm_paket }}</td>
                                                <td class="text-center">{{ $transaksi->paket->wahana }}</td>
                                                <td class="text-center">{{ $transaksi->paket->porsi }}</td>
                                                <td class="text-center">{{ $transaksi->barcode }}</td> <!-- Tampilkan kode unik -->
                                                <td class="text-center">
                                                    {!! QrCode::size(100)->generate($transaksi->barcode) !!}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <form action="{{ route('staff.transaksi.destroy', $transaksi->id) }}" method="POST" class="ml-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $transaksis->withQueryString()->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
