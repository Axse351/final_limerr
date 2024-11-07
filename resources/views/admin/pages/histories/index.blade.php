@extends('admin.layouts.app')

@section('title', 'Riwayat Transaksi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('admin.content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Riwayat Transaksi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Riwayat</a></div>
                    <div class="breadcrumb-item">Riwayat Transaksi</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('admin.layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Riwayat Transaksi</h4>
                            </div>
                            <div class="card-body">

                                {{-- <div class="float-left">
                                    <a href="{{ route('admin.history.create') }}" class="btn btn-primary">Tambah Riwayat</a>
                                </div> --}}

                                <div class="float-right">
                                    <form method="GET" action="{{ route('admin.histories.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari transaksi" name="search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th class="text-center">ID Transaksi</th>
                                            <th class="text-center">Nama Konsumen</th>
                                            <th class="text-center">Nama Paket</th>
                                            <th class="text-center">Jumlah Wahana</th>
                                            <th class="text-center">Jumlah Porsi</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Waktu</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        @foreach ($histories as $history)
                                            <tr>
                                                <td class="text-center">{{ $history->id }}</td>
                                                <td class="text-center">{{ $history->nama_konsumen }}</td>
                                                <td class="text-center">{{ $history->nama_paket }}</td>
                                                <td class="text-center">{{ $history->wahana }}</td>
                                                <td class="text-center">{{ $history->porsi }}</td>
                                                <td class="text-center">{{ $history->tanggal }}</td>
                                                <td class="text-center">{{ $history->jam }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        {{-- <a href='{{ route('admin.history.edit', $history->id) }}' class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i> Edit --}}
                                                        </a>

                                                        {{-- <form action="{{ route('admin.history.destroy', $history->id) }}" method="POST" class="ml-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Hapus
                                                            </button>
                                                        </form> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                                <div class="float-right">
                                    {{ $histories->withQueryString()->links() }}
                                </div>
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
