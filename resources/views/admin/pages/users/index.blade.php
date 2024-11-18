@extends('admin.layouts.app')

@section('title', 'Data Users')

@push('style')
@endpush

@section('admin.content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>LIMERR RESORT ADMIN</h1>
            </div>

            @if (session()->has('success'))
                <div class="alert alert-primary">
                    {{ session()->get('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fa fa-plus"> </i>
                        &nbsp;Tambah Data
                    </a>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Nama Wahana</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>{{ $item->namawahana }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', ['id' => $item->id]) }}"
                                                class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                            <form action="{{ route('admin.users.destroy', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Tidak Ada Data Users</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
