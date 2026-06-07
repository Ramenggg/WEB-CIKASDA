<?php

namespace App\View\Components;

use App\Models\Berita as BeritaModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Berita extends Component
{
    public $beritas;
    public $utama;
    public $sampingan;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        try {
            $this->beritas = BeritaModel::with('sampul')
                ->where('status', 'Publish')
                ->latest()
                ->take(5)
                ->get();

            $this->utama = $this->beritas->first();
            $this->sampingan = $this->beritas->skip(1);
        } catch (\Exception $e) {
            $this->beritas = collect();
            $this->utama = null;
            $this->sampingan = collect();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.berita', [
            'beritas' => $this->beritas,
            'utama' => $this->utama,
            'sampingan' => $this->sampingan,
        ]);
    }
}
