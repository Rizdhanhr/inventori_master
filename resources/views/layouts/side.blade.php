<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas  fa-warehouse"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Inventori </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('dashboard*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Barang
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
     <!-- Nav Item - Charts -->
     <li class="nav-item {{ (request()->is('barang*')) ? 'active' : '' }}" >
        <a class="nav-link" href="{{ route('barang.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Barang</span></a>
     </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ (request()->is('kategori*')) ? 'active' : '' }} {{ (request()->is('brand*')) ? 'active' : '' }} {{ (request()->is('satuan*')) ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Atribut</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ (request()->is('kategori*')) ? 'active' : '' }}" href="{{ route('kategori.index') }}">Kategori</a>
                <a class="collapse-item {{ (request()->is('brand*')) ? 'active' : '' }}" href="{{ route('brand.index') }}">Brand</a>
                <a class="collapse-item {{ (request()->is('satuan*')) ? 'active' : '' }}" href="{{ route('satuan.index') }}">Satuan</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
       Transaksi
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ (request()->is('transaksi-masuk*')) ? 'active' : '' }} {{ (request()->is('transaksi-keluar*')) ? 'active' : '' }} {{ (request()->is('penyesuaian*')) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Transaksi</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaksi :</h6>
                <a class="collapse-item {{ (request()->is('transaksi-masuk*')) ? 'active' : '' }}" href="{{ route('transaksi-masuk.index') }}">Barang Masuk</a>
                <a class="collapse-item {{ (request()->is('transaksi-keluar*')) ? 'active' : '' }}" href="{{ route('transaksi-keluar.index') }}">Barang Keluar</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Penyesuaian:</h6>
                <a class="collapse-item {{ (request()->is('penyesuaian*')) ? 'active' : '' }}" href="{{ route('penyesuaian.index') }}">Penyesuaian</a>
            </div>
        </div>
    </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Surat
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
      <!-- Nav Item - Charts -->
      <li class="nav-item {{ (request()->is('surat-jalan*')) ? 'active' : '' }}" >
         <a class="nav-link " href="{{ route('surat-jalan.index') }}">
             <i class="fas fa-fw fa-envelope"></i>
             <span>Surat Jalan</span></a>
      </li>

     <!-- Divider -->
     <hr class="sidebar-divider">
     <!-- Heading -->
     <div class="sidebar-heading">
        Laporan
     </div>
     <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ (request()->is('laporan-barang-keluar*')) ? 'active' : '' }} {{ (request()->is('laporan-barang-masuk*')) ? 'active' : '' }} {{ (request()->is('laporan-penyesuaian*')) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Laporan</span>
        </a>
        <div id="laporan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ (request()->is('laporan-barang-keluar*')) ? 'active' : '' }}" href="{{ route('laporan-barang-keluar.index') }}">Barang Keluar</a>
                <a class="collapse-item {{ (request()->is('laporan-barang-masuk*')) ? 'active' : '' }}" href="{{ route('laporan-barang-masuk.index') }}">Barang Masuk</a>
                <a class="collapse-item {{ (request()->is('laporan-penyesuaian*')) ? 'active' : '' }}" href="{{ route('laporan-penyesuaian.index') }}">Penyesuaian</a>
            </div>
        </div>
    </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
        Pelanggan & Supplier
     </div>
    <!-- Nav Item - Charts -->
    <li class="nav-item {{ (request()->is('pelanggan*')) ? 'active' : '' }}">
        <a class="nav-link "  href="{{ route('pelanggan.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Pelanggan</span></a>
    </li>
    <!-- Nav Item - Charts -->
    <li class="nav-item {{ (request()->is('supplier*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('supplier.index') }}">
            <i class="fas fa-truck"></i>
            <span>Supplier</span></a>
    </li>

    @if(Auth::check() && Auth::user()->level == "1")
     <!-- Divider -->
     <hr class="sidebar-divider">
     <!-- Heading -->
     <div class="sidebar-heading">
        Pengaturan
     </div>
    <!-- Nav Item - Tables -->
    <li class="nav-item {{ (request()->is('manajemen-user*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('manajemen-user.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Manajemen User</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->
