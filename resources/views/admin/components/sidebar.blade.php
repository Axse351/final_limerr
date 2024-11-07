<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand" style="margin-top: 70px;">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('img/logo1.png') }}" alt="" height="70px">
            </a>
            <p>&nbsp;</p>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">RB</a>
        </div>

        <ul class="sidebar-menu">
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa fa-home" style="color: #1F316F";></i>
                    <span style="color: #1F316F";>Berandaaa</span></a>
            </li>

            {{-- <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('staff.history.index') }}"><i class="far fa-fire"></i>
                    <span>Kelola Riwayat</span></a>
            </li> --}}
            <li class="{{ Request::is('admin.users*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.users') }}"><i class="fa fa-users"  style="color: #1F316F";></i>
                    <span  style="color: #1F316F";>Data Users</span></a>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.transaksi.index') }}"><i class="fa fa-shopping-cart"  style="color: #1F316F";></i>
                    <span  style="color: #1F316F";>Transaksi</span></a>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.scan.index') }}"><i class="fa fa-qrcode"  style="color: #1F316F";></i>
                    <span  style="color: #1F316F";>Scan Barcode</span></a>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.histories.index') }}"><i class="fa fa-book"  style="color: #1F316F";></i>
                    <span  style="color: #1F316F";>Histori</span></a>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.paket.index') }}"><i class="fa fa-cutlery" style="color: #1F316F";></i>
                    <span  style="color: #1F316F"; >Kategori Menu</span></a>
            </li>
            {{--  
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Kelola
                        Produk</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('staff.product.index') }}">Kelola Bahan Baku</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('staff.storage_one.index') }}">Kelola Storage 1</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('staff.storage_two.index') }}">Kelola Storage 2</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('staff.product_result.index') }}">Kelola Barang Jadi</a>
                    </li>
                </ul>
            </li>
            --}}
</div>
