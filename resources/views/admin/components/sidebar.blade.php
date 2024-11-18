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
            <li class="{{ Request::is('admin.wa.index*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.wa.index') }}"><i class="fa fa-comments" style="color: #1F316F";></i>
                    <span  style="color: #1F316F"; >Wa Sender Setting</span></a>
            </li>
        </ul>
</div>
