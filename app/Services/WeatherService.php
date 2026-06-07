<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class WeatherService
{
    // ADM4 Code for Tatura Utara, Palu Selatan
    private const ADM4_CODE = '72.71.03.1001';
    private const BMKG_API_URL = 'https://api.bmkg.go.id/publik/prakiraan-cuaca';
    private const CACHE_KEY = 'weather_palu_selatan_v2';
    private const CACHE_TTL = 3600;

    /**
     * Mengambil data cuaca Palu Selatan (Cached)
     */
    public function getPaluWeather()
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return $this->fetchFromBmkg();
        });
    }

    /**
     * Mengambil data dari API JSON BMKG Terbaru (2026)
     */
    private function fetchFromBmkg()
    {
        try {
            $response = Http::timeout(10)->get(self::BMKG_API_URL, [
                'adm4' => self::ADM4_CODE
            ]);

            if (!$response->successful()) {
                Log::warning('WeatherService: API BMKG mengembalikan status ' . $response->status());
                return $this->fallbackData();
            }

            $json = $response->json();
            
            if (!isset($json['data'][0]['cuaca'])) {
                Log::warning('WeatherService: Struktur data BMKG tidak sesuai.');
                return $this->fallbackData();
            }

            $weatherDays = $json['data'][0]['cuaca'];
            $now = Carbon::now('Asia/Makassar');
            
            // Mencari data saat ini (yang paling mendekati jam sekarang)
            $currentData = $this->findNearestForecast($weatherDays[0], $now);

            return [
                'location' => 'Palu Selatan',
                'full_location' => $json['lokasi']['desa'] . ', ' . $json['lokasi']['kecamatan'],
                'date' => $now->translatedFormat('l, d F Y'),
                'current' => [
                    'temp' => $currentData['t'],
                    'humidity' => $currentData['hu'],
                    'wind_speed' => $currentData['ws'] . ' Km/Jam',
                    'wind_dir' => $this->mapWindDir($currentData['wd']),
                    'description' => $currentData['weather_desc'],
                    'icon' => $this->mapWeatherIcon($currentData['weather']),
                ],
                'hourly' => $this->parseHourly($weatherDays, $now),
                'source' => 'BMKG',
            ];
        } catch (\Exception $e) {
            Log::error('WeatherService Error: ' . $e->getMessage());
            return $this->fallbackData();
        }
    }

    private function mapWindDir(string $dir)
    {
        $map = [
            'N' => 'Utara', 'NNE' => 'Utara Timur Laut', 'NE' => 'Timur Laut', 'ENE' => 'Timur Timur Laut',
            'E' => 'Timur', 'ESE' => 'Timur Menenggara', 'SE' => 'Tenggara', 'SSE' => 'Selatan Menenggara',
            'S' => 'Selatan', 'SSW' => 'Selatan Barat Daya', 'SW' => 'Barat Daya', 'WSW' => 'Barat Barat Daya',
            'W' => 'Barat', 'WNW' => 'Barat Laut', 'NW' => 'Barat Laut', 'NNW' => 'Utara Barat Laut'
        ];
        return $map[$dir] ?? $dir;
    }

    /**
     * Mencari forecast yang paling dekat dengan waktu target
     */
    private function findNearestForecast(array $forecasts, Carbon $targetTime)
    {
        $bestMatch = $forecasts[0];
        $minDiff = PHP_INT_MAX;

        foreach ($forecasts as $f) {
            $dt = Carbon::parse($f['local_datetime']);
            $diff = abs($dt->timestamp - $targetTime->timestamp);

            if ($diff < $minDiff) {
                $minDiff = $diff;
                $bestMatch = $f;
            }
        }

        return $bestMatch;
    }

    /**
     * Mengambil 5 periode prakiraan ke depan
     */
    private function parseHourly(array $weatherDays, Carbon $now)
    {
        $allForecasts = array_merge($weatherDays[0], $weatherDays[1] ?? []);
        $upcoming = [];

        foreach ($allForecasts as $f) {
            $dt = Carbon::parse($f['local_datetime']);
            
            if ($dt->isAfter($now) && count($upcoming) < 4) {
                $upcoming[] = [
                    'time' => $dt->format('H.i'),
                    'temp' => $f['t'],
                    'hu' => $f['hu'],
                    'icon' => $this->mapWeatherIcon($f['weather']),
                    'desc' => $f['weather_desc'],
                ];
            }
        }

        return $upcoming;
    }

    /**
     * Mapping kode cuaca BMKG ke Ikon Material Symbols
     */
    private function mapWeatherIcon(int|string $code)
    {
        $code = (int)$code;
        $map = [
            0 => 'wb_sunny',             // Cerah
            1 => 'partly_cloudy_day',    // Cerah Berawan
            2 => 'partly_cloudy_day',    // Cerah Berawan
            3 => 'cloud',                // Berawan
            4 => 'cloudy',               // Berawan Tebal
            5 => 'mist',                 // Udara Kabur
            10 => 'smoke',               // Asap
            45 => 'foggy',               // Kabut
            60 => 'rainy_light',         // Hujan Ringan
            61 => 'rainy',               // Hujan Sedang
            63 => 'rainy_heavy',         // Hujan Lebat
            80 => 'rainy_light',         // Hujan Lokal
            95 => 'thunderstorm',        // Hujan Petir
            97 => 'thunderstorm',        // Hujan Petir
        ];

        return $map[$code] ?? 'cloud';
    }

    private function fallbackData()
    {
        return [
            'location' => 'Palu Selatan, Sulteng',
            'date' => Carbon::now()->translatedFormat('l, d F Y'),
            'current' => [
                'temp' => '-',
                'humidity' => '-',
                'wind_speed' => '-',
                'wind_dir' => '-',
                'description' => 'Data tidak tersedia',
                'icon' => 'cloud_off',
            ],
            'hourly' => [],
            'source' => 'Offline',
        ];
    }
}
