<?php

namespace App\Providers;

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
        // Bagian: View Composer untuk Sekilas Dinas Sidebar
        // Kita gunakan wildcard 'components.*' agar mencakup komponen sidebar
        // dan layout utama jika diperlukan.
        view()->composer(['components.sekilas-dinas-sidebar', 'layouts.app'], function ($view) {
            try {
                $sekilasItem = \App\Models\ProfilItem::where('slug', 'sekilas-dinas')->first();
                $sekilasDinas = [];
                
                if ($sekilasItem && !empty($sekilasItem->content_data)) {
                    $decoded = json_decode($sekilasItem->content_data, true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        $sekilasDinas = $decoded;
                    }
                }
                
                $view->with('sekilasDinas', $sekilasDinas);
            } catch (\Exception $e) {
                $view->with('sekilasDinas', []);
            }
        });
    }
}
