<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="{{ auth()->user()->role == 'admin' ? url('/admin/dashboard') : (auth()->user()->role == 'pengurus' ? url('/pengurus/dashboard') : url('/mahasiswa/dashboard')) }}"
                class="logo">
                <span class="navbar-brand" style="color: white; font-weight: bold;">Manajemen UKM</span>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
            </div>
        </div>
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                {{-- DASHBOARD SECTION --}}
                @if(auth()->user()->role == 'admin')
                    <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ url('/admin/dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard Admin</p>
                        </a>
                    </li>
                @elseif(auth()->user()->role == 'pengurus')
                    <li class="nav-item {{ Request::is('pengurus/dashboard') ? 'active' : '' }}">
                        <a href="{{ url('/pengurus/dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard UKM</p>
                        </a>
                    </li>
                @elseif(auth()->user()->role == 'mahasiswa')
                    <li class="nav-item {{ Request::is('mahasiswa/dashboard') ? 'active' : '' }}">
                        <a href="{{ url('/mahasiswa/dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard Saya</p>
                        </a>
                    </li>
                @endif

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu Utama</h4>
                </li>

                {{-- MENU KHUSUS ADMIN --}}
                @if(auth()->user()->role == 'admin')
                    <li class="nav-item {{ Route::is('admin.ukm.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.ukm.index') }}">
                            <i class="fas fa-university"></i>
                            <p>Daftar UKM</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('admin.users.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fas fa-users-cog"></i>
                            <p>Manajemen User</p>
                        </a>
                    </li>
                @endif

                {{-- MENU KHUSUS PENGURUS --}}
@if(auth()->user()->role == 'pengurus')
    {{-- Menu Kelola Event (Lama) --}}
    <li class="nav-item {{ Route::is('pengurus.event.index') ? 'active' : '' }}">
        <a href="{{ route('pengurus.event.index') }}">
            <i class="fas fa-tasks"></i>
            <p>Kelola Event Kami</p>
        </a>
    </li>

    {{-- Menu Anggota UKM (Lama) --}}
    <li class="nav-item {{ Route::is('pengurus.anggota.index') ? 'active' : '' }}">
        <a href="{{ route('pengurus.anggota.index') }}">
            <i class="fas fa-users"></i>
            <p>Anggota UKM</p>
        </a>
    </li>

    {{-- MENU BARU: Pendaftar Event --}}
    <li class="nav-item {{ Route::is('pengurus.pendaftar.index') ? 'active' : '' }}">
        <a href="{{ route('pengurus.pendaftar.index') }}">
            <i class="fas fa-user-check"></i>
            <p>Pendaftar Event</p>
        </a>
    </li>
@endif

                {{-- MENU KHUSUS MAHASISWA --}}
                @if(auth()->user()->role == 'mahasiswa')
                    <li class="nav-item {{ Route::is('mahasiswa.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('mahasiswa.dashboard') }}">
                            <i class="fas fa-th-large"></i>
                            <p>Dashboard Saya</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}">
                            <i class="fas fa-search"></i>
                            <p>Cari Event & UKM</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
