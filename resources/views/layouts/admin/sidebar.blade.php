<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Nav::isRoute('admin.home') }}">
        <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="fas fa-fw fa-house"></i>
            <span>{{ __('Dashboard') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        {{ __('Master Data') }}
    </div>
    <!-- Nav Item - Prodi -->
    <li class="nav-item {{ Nav::isRoute('admin.prodi.index') }}">
        <a class="nav-link" href="{{ route('admin.prodi.index') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>{{ __('Prodi') }}</span></a>
    </li>
    <!-- Nav Item - Mahasiswa -->
    <li class="nav-item {{ Nav::isRoute('admin.mahasiswa.index') }}">
        <a class="nav-link" href="{{ route('admin.mahasiswa.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Mahasiswa') }}</span></a>
    </li>
    <!-- Nav Item - Mata Kuliah -->
    <li class="nav-item {{ Nav::isRoute('admin.matkul.index') }}">
        <a class="nav-link" href="{{ route('admin.matkul.index') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>{{ __('Mata Kuliah') }}</span></a>
    </li>

    <!-- Nav Item - Dosen -->
    <li class="nav-item {{ Nav::isRoute('admin.dosen.index') }}">
        <a class="nav-link" href="{{ route('admin.dosen.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Dosen') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        {{ __('Transaksi') }}
    </div>

    <!-- Nav Item - Kelas -->
    <li class="nav-item {{ Nav::isRoute('admin.kelas.index') }}">
        <a class="nav-link" href="{{ route('admin.kelas.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Kelas') }}</span></a>
    </li>
    <!-- Nav Item - Penilaian -->
    <li class="nav-item {{ Nav::isRoute('admin.penilaian.index') }}">
        <a class="nav-link" href="{{ route('admin.penilaian.index') }}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>{{ __('Penilaian') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Settings') }}
    </div>

    <!-- Nav Item - Profile -->
    <li class="nav-item {{ Nav::isRoute('admin.profile') }}">
        <a class="nav-link" href="{{ route('admin.profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Profile') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
