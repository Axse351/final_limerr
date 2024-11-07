@extends('staff.layouts.app')

@section('title', 'transaksi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
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

                                <h1>Detail Transaksi</h1>
                                <p>ID: {{ $transaksi->id }}</p>
                                <p>Nama Konsumen: {{ $transaksi->nm_konsumen }}</p>
                                <p>Nomor Handphone: {{ $transaksi->nohp }}</p>
                                <p>Paket: {{ $transaksi->paket_id }}</p>
                                <p>Wahana: {{ $transaksi->wahana }}</p>
                                <p>Porsi: {{ $transaksi->porsi }}</p>
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
