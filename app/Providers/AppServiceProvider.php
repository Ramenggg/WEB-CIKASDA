<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

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
        \Illuminate\Support\Facades\Blade::component('berita', \App\View\Components\Berita::class);

        // Bagian: View Composer untuk Sekilas Dinas Sidebar
        view()->composer(['components.sekilas-dinas-sidebar', 'layouts.app'], function ($view) {
            try {
                $sekilasItem = \App\Models\ProfilItem::where('slug', 'sekilas-dinas')->first();
                $sekilasDinas = [];
                
                if ($sekilasItem && !empty($sekilasItem->content_data) && is_array($sekilasItem->content_data)) {
                    $sekilasDinas = $sekilasItem->content_data;
                }
                
                $view->with('sekilasDinas', $sekilasDinas);
            } catch (\Exception $e) {
                $view->with('sekilasDinas', []);
            }
        });

        // Bagian: View Composer untuk Widget Cuaca Palu
        // Target langsung ke file komponen agar variabel selalu tersedia di dalam widget
        view()->composer('components.weather-widget', function ($view) {
            try {
                $weatherService = app(\App\Services\WeatherService::class);
                $view->with('weatherData', $weatherService->getPaluWeather());
            } catch (\Exception $e) {
                Log::error('Weather ViewComposer Error: ' . $e->getMessage());
                $view->with('weatherData', null);
            }
        });
    }
}
