<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="/assets/images/logos/dark-logo.svg" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a @class([
                        'sidebar-link',
                        'active' => request()->segment(1) == 'pegawai',
                    ]) href="/pegawai" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Pegawai</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Master Data</span>
                </li>
                <li class="sidebar-item">
                    <a @class([
                        'sidebar-link',
                        'active' => request()->segment(1) == 'rumah-ibadah',
                    ]) href="/rumah-ibadah" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Rumah Ibadah</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a @class([
                        'sidebar-link',
                        'active' => request()->segment(1) == 'jenis-cuti',
                    ]) href="/jenis-cuti" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Jenis Cuti</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a @class([
                        'sidebar-link',
                        'active' => request()->segment(1) == 'jenis-kendaraan',
                    ]) href="/jenis-kendaraan" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Jenis Kendaraan</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Pengajuan</span>
                </li>
                <li class="sidebar-item">
                    <a @class([
                        'sidebar-link',
                        'active' => request()->segment(1) == 'surat-cuti',
                    ]) href="./ui-buttons.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Surat Cuti</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a @class([
                        'sidebar-link',
                        'text-wrap',
                        'active' => request()->segment(1) == 'spdp',
                    ]) href="./ui-buttons.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Surat Perintah Perjalanan Dinas (SPDP)</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Permohonan</span>
                </li>
                <li class="sidebar-item">
                    <a @class([
                        'sidebar-link',
                        'active' => request()->segment(1) == 'surat-izin-riset',
                    ]) href="/surat-izin-riset" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Surat Izin Riset</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a @class([
                        'sidebar-link',
                        'active' => request()->segment(1) == 'surat-pkl-magang',
                    ]) href="/surat-pkl-magang" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Surat PKL/Magang</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a @class([
                        'sidebar-link',
                        'active' => request()->segment(1) == 'surat-ukur-kibtal',
                    ]) href="/surat-ukur-kiblat" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Surat Ukur Kiblat</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
