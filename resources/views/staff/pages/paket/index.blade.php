@extends('staff.layouts.app')

@section('title', 'paket')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('staff.content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Paket</h1>
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
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Paket</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-ledt">
                                    <a href="{{ route('staff.paket.create') }}" class="btn btn-primary">Tambah Paket</a>
                                </div>

                                <div class="float-right">
                                    <form method="GET" action="{{ route('staff.paket.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
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
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Paket</th>
                                            <th class="text-center">Wahana</th>
                                            <th class="text-center">Porsi</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        @foreach ($pakets as $paket)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $paket->nm_paket }}</td>
                                                <td class="text-center">{{ $paket->wahana }}</td>
                                                <td class="text-center">{{ $paket->porsi }}</td>
                                                <td>
                                                    {{-- <a href="{{ route('pakets.show', $paket->id) }}" class="btn btn-info btn-sm">Detail</a> --}}
                                                    {{-- <a href="{{ route('pakets.edit', $paket->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                                                    <form action={{-- "{{ route('pakets.destroy', $paket->id) }}" --}} method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </table>
                                </div>
                                <div class="float-right">
                                    {{-- {{ $paket->withQueryString()->links() }} --}}
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
