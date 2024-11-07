<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('staff.home') }}">
                <img src="{{ asset('img/s3shop.png') }}" alt="">
            </a>
            <p>&nbsp;</p>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">RB</a>
        </div>

        @php
            $role = auth()->user()->role; // Misalnya, ini didapat dari database atau logika lainnya
        @endphp
        <ul class="sidebar-menu">

            @if ($role === 'admin')
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.home') }}"><i class="far fa-fire"></i>
                    <span>Beranda</span></a>
            </li>
        @elseif ($role === 'staff')
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('staff.home') }}"><i class="far fa-fire"></i>
                    <span>Beranda</span></a>
            </li>
        @elseif ($role === 'scan1')
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('scan1.home') }}"><i class="far fa-fire"></i>
                    <span>Beranda</span></a>
            </li>
        @elseif ($role === 'scan2')
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('scan2.home') }}"><i class="far fa-fire"></i>
                    <span>Beranda</span></a>
            </li>
        @endif

            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('history.index') }}"><i class="far fa-fire"></i>
                    <span>Kelola Riwayat</span></a>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('categories.index') }}"><i class="far fa-fire"></i> <span>Kelola
                        Kategori</span></a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Kelola
                        Produk</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('product.index') }}">Kelola Bahan Baku</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('storage_one.index') }}">Kelola Storage 1</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('storage_two.index') }}">Kelola Storage 2</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('product_result.index') }}">Kelola Barang Jadi</a>
                    </li>
                </ul>
            </li>
</div>
