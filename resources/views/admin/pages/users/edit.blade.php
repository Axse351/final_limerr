@extends('admin.layouts.app')

@section('title', 'Edit Users')

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
                    <form action="{{route('admin.users.update', ['id' => $users->id])}}" method="POST">
                        @csrf
                        @method("PUT")
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{$users->name}}">
                            @error('name')
                                <span class="invalid-feedback">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{$users->email}}">
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
                                    <option value="{{$item}}" {{$users->role == $item ? 'selected' : ''}}>{{$item}}</option>
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
                            <input type="text" name="namawahana" id="namawahana" class="form-control @error('namawahana') is-invalid @enderror" value="{{$users->namawahana}}">
                            @error('namawahana')
                                <span class="invalid-feedback">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>


                        <button type="reset" class="btn btn-secondary float-left">Reset</button>
                        <button type="submit" class="btn btn-primary float-right">Ubah</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
