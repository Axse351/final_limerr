@extends('staff.layouts.app')

@section('title', 'Barang Jadi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('staff.content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Storage One</h1>
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
                                <h4>Storage 1</h4>
                            </div>
                            <div class="card-body">

                                <div class="float-ledt">
                                    <a href="{{ route('staff.storage_one.create') }}" class="btn btn-primary">Konversi
                                        S1</a>
                                </div>

                                <div class="float-right">
                                    <form method="GET" action="{{ route('staff.storage_one.index') }}">
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
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Nomor Produksi</th>
                                            <th class="text-center">Karyawan</th>
                                            <th class="text-center">Bagian</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Satuan</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        @foreach ($storage_ones as $storage_one)
                                            <tr>
                                                <td class="text-center">{{ $storage_one->date }}</td>
                                                <td class="text-center">{{ $storage_one->nomor_produksi }}</td>
                                                <td class="text-center">{{ $storage_one->karyawan }}</td>
                                                <td class="text-center">{{ $storage_one->bagian }}</td>
                                                <td class="text-center">{{ $storage_one->product }}</td>
                                                <td class="text-center">{{ $storage_one->qty }}</td>
                                                <td class="text-center">{{ $storage_one->satuan }}</td>
                                                <td class="text-center">{{ $storage_one->harga_satuan }}</td>
                                                <td class="text-center">{{ $storage_one->total }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        {{-- <a href='{{ route('staff.storage_one.edit', $storage_one->id) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a> --}}

                                                        <form
                                                            action="{{ route('staff.storage_one.destroy', $storage_one->id) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
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
                                    {{-- {{ $storage_ones->withQueryString()->links() }} --}}
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
