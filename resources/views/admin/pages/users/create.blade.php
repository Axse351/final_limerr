@extends('admin.layouts.app')

@section('title', 'Tambah Users')

@push('style')
@endpush

@section('admin.content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>LIMERR RESORT ADMIN</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.users.store')}}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span class="invalid-feedback">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="invalid-feedback">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Role</label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                <option value="">- Pilih -</option>
                                @foreach ($roles as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="invalid-feedback">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Nama Wahana</label>
                            <input type="text" name="namawahana" id="namawahana" class="form-control @error('namawahana') is-invalid @enderror">
                            @error('namawahana')
                                <span class="invalid-feedback">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>


                        <button type="reset" class="btn btn-secondary float-left">Reset</button>
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
