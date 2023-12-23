<?php

namespace App\Providers;

use App\Models\Pengajuan\Pengajuan;
use App\Models\Permohonan\Permohonan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!app()->runningInConsole()) {
            $sidebarNotif = [
                'pengajuan_cuti'                        => Pengajuan::whereHas('pengajuanCuti')->doesntHave('pengajuanTerverifikasi')->count(),
                'pengajuan_izin'                        => Pengajuan::whereHas('pengajuanIzin')->doesntHave('pengajuanTerverifikasi')->count(),
                'pengajuan_spdp'                        => Pengajuan::whereHas('pengajuanSPDP')->doesntHave('pengajuanTerverifikasi')->count(),
                'permohonan_magang_pkl'                 => Permohonan::whereHas('magangPKL')->doesntHave('permohonanTerverifikasi')->count(),
                'permohonan_ukur_kiblat'                => Permohonan::whereHas('ukurKiblat')->doesntHave('permohonanTerverifikasi')->count(),
                'permohonan_pendaftaran_rumah_ibadah'   => Permohonan::whereHas('pendaftaranRumahIbadah')->doesntHave('permohonanTerverifikasi')->count(),
                'permohonan_riset'                      => Permohonan::whereHas('riset')->doesntHave('permohonanTerverifikasi')->count(),
            ];
            View::share('sidebarNotif', $sidebarNotif);
        }
    }
}
