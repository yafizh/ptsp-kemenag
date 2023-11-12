<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="d-flex justify-content-end p-3">
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <div class="brand-logo d-flex align-items-center justify-content-center flex-column text-center">
            <img src="/assets/images/logos/kemenag.png" width="120" />
            <h5 class="mb-0 my-3">PELAYANAN TERPADU SATU PINTU (PTSP)</h5>
            <h5>KEMENTERIAN AGAMA</h5>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                @if (auth()->user()->status == \App\Enums\User\UserStatus::ADMIN)
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' => request()->segment(2) == 'pegawai',
                        ]) href="/{{ auth()->user()->status->route() }}/pegawai"
                            aria-expanded="false">
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
                            'active' => request()->segment(2) == 'rumah-ibadah',
                        ]) href="/{{ auth()->user()->status->route() }}/rumah-ibadah"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Rumah Ibadah</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' => request()->segment(2) == 'jenis-cuti',
                        ]) href="/{{ auth()->user()->status->route() }}/jenis-cuti"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Jenis Cuti</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' => request()->segment(2) == 'jenis-kendaraan',
                        ]) href="/{{ auth()->user()->status->route() }}/jenis-kendaraan"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Jenis Kendaraan</span>
                        </a>
                    </li>
                @endif
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Pengajuan</span>
                </li>
                <li class="sidebar-item">
                    <a @class([
                        'sidebar-link',
                        'active' => request()->segment(2) == 'surat-cuti',
                    ]) href="/{{ auth()->user()->status->route() }}/1"
                        aria-expanded="false">
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
                        'active' => request()->segment(2) == 'spdp',
                    ]) href="/{{ auth()->user()->status->route() }}/2"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Surat Perintah Perjalanan Dinas (SPDP)</span>
                    </a>
                </li>
                @if (auth()->user()->status == \App\Enums\User\UserStatus::PIMPINAN ||
                        auth()->user()->status == \App\Enums\User\UserStatus::ADMIN)
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Permohonan</span>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' => request()->segment(2) == 'surat-izin-riset',
                        ]) href="/{{ auth()->user()->status->route() }}/surat-izin-riset"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Pendaftaran Rumah Ibadah</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' => request()->segment(2) == 'surat-pkl-magang',
                        ]) href="/{{ auth()->user()->status->route() }}/surat-pkl-magang"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">PKL/Magang</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' => request()->segment(2) == 'surat-ukur-kibtal',
                        ]) href="/{{ auth()->user()->status->route() }}/surat-ukur-kiblat"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Pengukuran Kiblat</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
