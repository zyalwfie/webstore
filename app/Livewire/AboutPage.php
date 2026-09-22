<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Tag;
use Livewire\Attributes\Title;
use Livewire\Component;

class AboutPage extends Component
{
    #[Title('Tentang Kami — Webstore')]
    public function render()
    {
        $stats = [
            ['value' => '12rb+', 'label' => 'Developer bergabung'],
            ['value' => Product::query()->count().'+', 'label' => 'Kelas & ebook'],
            ['value' => Tag::query()->withType('collection')->count().'+', 'label' => 'Topik pembelajaran'],
            ['value' => '4.9/5', 'label' => 'Rating alumni'],
        ];

        return view('livewire.about-page', compact('stats'));
    }
}
