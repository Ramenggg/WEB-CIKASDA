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
        view()->composer('pages.profil.*', function ($view) {
            $sekilasItem = \App\Models\ProfilItem::where('slug', 'sekilas-dinas')->first();
            $sekilasDinas = [];
            if ($sekilasItem && !empty($sekilasItem->content_data)) {
                $sekilasDinas = json_decode($sekilasItem->content_data, true) ?? [];
            }
            $view->with('sekilasDinas', $sekilasDinas);
        });
    }
}
