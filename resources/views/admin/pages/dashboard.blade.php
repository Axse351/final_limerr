@extends('admin.layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('admin.content')
    <div class="main-content">
        <section class="section">
            <div class="section-header text-center mb-3">
                <h1 class="h3 text-uppercase">LIMERR RESORT ADMIN</h1>
            </div>

            <div class="row justify-content-center align-items-center" style="height: 80vh;">
                <div class="col-lg-6 col-md-10 col-12 col-sm-12">
                    <div class="card text-center shadow-sm p-3">
                        <h1 class="display-5 text-primary mb-1">WELCOME TO DASHBOARD</h1>
                        <p class="text-secondary small">Manage your application and view insights here!</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
