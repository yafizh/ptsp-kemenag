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
                                <i class="ti ti-user"></i>
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
                            'active' => request()->segment(2) == 'pangkat',
                        ]) href="/{{ auth()->user()->status->route() }}/pangkat"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-user-code"></i>
                            </span>
                            <span class="hide-menu">Pangkat</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' => request()->segment(2) == 'golongan',
                        ]) href="/{{ auth()->user()->status->route() }}/golongan"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-user-pause"></i>
                            </span>
                            <span class="hide-menu">Golongan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' => request()->segment(2) == 'jabatan',
                        ]) href="/{{ auth()->user()->status->route() }}/jabatan"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-user-scan"></i>
                            </span>
                            <span class="hide-menu">Jabatan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' => request()->segment(2) == 'biaya-perjalanan-dinas',
                        ])
                            href="/{{ auth()->user()->status->route() }}/biaya-perjalanan-dinas" aria-expanded="false">
                            <span>
                                <i class="ti ti-home-dollar"></i>
                            </span>
                            <span class="hide-menu">Biaya Perjalan Dinas</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' => request()->segment(2) == 'rumah-ibadah',
                        ]) href="/{{ auth()->user()->status->route() }}/rumah-ibadah"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-building-church"></i>
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
                                <i class="ti ti-clock-play"></i>
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
                                <i class="ti ti-motorbike"></i>
                            </span>
                            <span class="hide-menu">Jenis Transportasi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' => request()->segment(2) == 'jenis-izin',
                        ]) href="/{{ auth()->user()->status->route() }}/jenis-izin"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-license"></i>
                            </span>
                            <span class="hide-menu">Jenis Izin</span>
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
                        'active' =>
                            request()->segment(2) == 'pengajuan-cuti' &&
                            request()->segment(3) !== 'laporan',
                    ]) href="/{{ auth()->user()->status->route() }}/pengajuan-cuti"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-file-text"></i>
                        </span>
                        <span class="hide-menu">
                            Cuti
                            @if (auth()->user()->status == \App\Enums\User\UserStatus::PIMPINAN ||
                                    auth()->user()->status == \App\Enums\User\UserStatus::ADMIN)
                                <strong>{{ $sidebarNotif['pengajuan_cuti'] > 0 ? '(' . $sidebarNotif['pengajuan_cuti'] . ')' : '' }}</strong>
                            @endif
                        </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a @class([
                        'sidebar-link',
                        'text-wrap',
                        'active' =>
                            request()->segment(2) == 'pengajuan-spdp' &&
                            request()->segment(3) !== 'laporan',
                    ]) href="/{{ auth()->user()->status->route() }}/pengajuan-spdp"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-file-text"></i>
                        </span>
                        <span class="hide-menu">
                            Surat Perintah Perjalanan Dinas (SPDP)
                            @if (auth()->user()->status == \App\Enums\User\UserStatus::PIMPINAN ||
                                    auth()->user()->status == \App\Enums\User\UserStatus::ADMIN)
                                <strong>{{ $sidebarNotif['pengajuan_spdp'] > 0 ? '(' . $sidebarNotif['pengajuan_spdp'] . ')' : '' }}</strong>
                            @endif
                        </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a @class([
                        'sidebar-link',
                        'active' =>
                            request()->segment(2) == 'pengajuan-izin' &&
                            request()->segment(3) !== 'laporan',
                    ]) href="/{{ auth()->user()->status->route() }}/pengajuan-izin"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-file-text"></i>
                        </span>
                        <span class="hide-menu">
                            Izin
                            @if (auth()->user()->status == \App\Enums\User\UserStatus::PIMPINAN ||
                                    auth()->user()->status == \App\Enums\User\UserStatus::ADMIN)
                                <strong>{{ $sidebarNotif['pengajuan_izin'] > 0 ? '(' . $sidebarNotif['pengajuan_izin'] . ')' : '' }}</strong>
                            @endif
                        </span>
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
                            'text-wrap',
                            'active' =>
                                request()->segment(2) == 'permohonan-pendaftaran-rumah-ibadah' &&
                                request()->segment(3) !== 'laporan',
                        ])
                            href="/{{ auth()->user()->status->route() }}/permohonan-pendaftaran-rumah-ibadah"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-file-text"></i>
                            </span>
                            <span class="hide-menu">
                                Pendaftaran Rumah Ibadah
                                @if (auth()->user()->status == \App\Enums\User\UserStatus::PIMPINAN ||
                                        auth()->user()->status == \App\Enums\User\UserStatus::ADMIN)
                                    <strong>{{ $sidebarNotif['permohonan_pendaftaran_rumah_ibadah'] > 0 ? '(' . $sidebarNotif['permohonan_pendaftaran_rumah_ibadah'] . ')' : '' }}</strong>
                                @endif
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'text-wrap',
                            'active' =>
                                request()->segment(2) == 'permohonan-riset' &&
                                request()->segment(3) !== 'laporan',
                        ]) href="/{{ auth()->user()->status->route() }}/permohonan-riset"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-file-text"></i>
                            </span>
                            <span class="hide-menu">
                                Riset
                                @if (auth()->user()->status == \App\Enums\User\UserStatus::PIMPINAN ||
                                        auth()->user()->status == \App\Enums\User\UserStatus::ADMIN)
                                    <strong>{{ $sidebarNotif['permohonan_riset'] > 0 ? '(' . $sidebarNotif['permohonan_riset'] . ')' : '' }}</strong>
                                @endif
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' =>
                                request()->segment(2) == 'surat-pkl-magang' &&
                                request()->segment(3) !== 'laporan',
                        ])
                            href="/{{ auth()->user()->status->route() }}/permohonan-magang-pkl" aria-expanded="false">
                            <span>
                                <i class="ti ti-file-text"></i>
                            </span>
                            <span class="hide-menu">
                                PKL/Magang
                                @if (auth()->user()->status == \App\Enums\User\UserStatus::PIMPINAN ||
                                        auth()->user()->status == \App\Enums\User\UserStatus::ADMIN)
                                    <strong>{{ $sidebarNotif['permohonan_magang_pkl'] > 0 ? '(' . $sidebarNotif['permohonan_magang_pkl'] . ')' : '' }}</strong>
                                @endif
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' =>
                                request()->segment(2) == 'permohonan-ukur-kiblat' &&
                                request()->segment(3) !== 'laporan',
                        ])
                            href="/{{ auth()->user()->status->route() }}/permohonan-ukur-kiblat"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-file-text"></i>
                            </span>
                            <span class="hide-menu">
                                Pengukuran Kiblat
                                @if (auth()->user()->status == \App\Enums\User\UserStatus::PIMPINAN ||
                                        auth()->user()->status == \App\Enums\User\UserStatus::ADMIN)
                                    <strong>{{ $sidebarNotif['permohonan_ukur_kiblat'] > 0 ? '(' . $sidebarNotif['permohonan_ukur_kiblat'] . ')' : '' }}</strong>
                                @endif
                            </span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Laporan</span>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' =>
                                request()->segment(2) == 'pengajuan-cuti' &&
                                request()->segment(3) == 'laporan',
                        ])
                            href="/{{ auth()->user()->status->route() }}/pengajuan-cuti/laporan"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-report"></i>
                            </span>
                            <span class="hide-menu">Peganjuan Cuti</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' =>
                                request()->segment(2) == 'pengajuan-izin' &&
                                request()->segment(3) == 'laporan',
                        ])
                            href="/{{ auth()->user()->status->route() }}/pengajuan-izin/laporan"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-report"></i>
                            </span>
                            <span class="hide-menu">Peganjuan Izin</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'active' =>
                                request()->segment(2) == 'pengajuan-spdp' &&
                                request()->segment(3) == 'laporan',
                        ])
                            href="/{{ auth()->user()->status->route() }}/pengajuan-spdp/laporan"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-report"></i>
                            </span>
                            <span class="hide-menu">Peganjuan SPDP</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'text-wrap',
                            'active' =>
                                request()->segment(2) == 'permohonan-pendaftaran-rumah-ibadah' &&
                                request()->segment(3) == 'laporan',
                        ])
                            href="/{{ auth()->user()->status->route() }}/permohonan-pendaftaran-rumah-ibadah/laporan"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-report"></i>
                            </span>
                            <span class="hide-menu">Permohonan Pendaftaran Rumah Ibadah</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'text-wrap',
                            'active' =>
                                request()->segment(2) == 'permohonan-magang-pkl' &&
                                request()->segment(3) == 'laporan',
                        ])
                            href="/{{ auth()->user()->status->route() }}/permohonan-magang-pkl/laporan"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-report"></i>
                            </span>
                            <span class="hide-menu">Permohonan Magang/PKL</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'text-wrap',
                            'active' =>
                                request()->segment(2) == 'permohonan-ukur-kiblat' &&
                                request()->segment(3) == 'laporan',
                        ])
                            href="/{{ auth()->user()->status->route() }}/permohonan-ukur-kiblat/laporan"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-report"></i>
                            </span>
                            <span class="hide-menu">Permohonan Pengukuran Kiblat</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a @class([
                            'sidebar-link',
                            'text-wrap',
                            'active' =>
                                request()->segment(2) == 'permohonan-riset' &&
                                request()->segment(3) == 'laporan',
                        ])
                            href="/{{ auth()->user()->status->route() }}/permohonan-riset/laporan"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-report"></i>
                            </span>
                            <span class="hide-menu">Permohonan Riset</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
