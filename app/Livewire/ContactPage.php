<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactPage extends Component
{
    #[Validate('required|string|min:3|max:60')]
    public string $name = '';

    #[Validate('required|email|max:120')]
    public string $email = '';

    #[Validate('required|string|min:3|max:100')]
    public string $subject = '';

    #[Validate('required|string|min:10|max:1000')]
    public string $message = '';

    public bool $sent = false;

    public function submit()
    {
        $this->validate();

        // Di produksi, kirim ke email support / simpan ke database.
        // Untuk demo, kita tandai pesan berhasil terkirim.
        $this->sent = true;

        $this->reset(['name', 'email', 'subject', 'message']);
    }

    #[Title('Kontak — Webstore')]
    public function render()
    {
        return view('livewire.contact-page');
    }
}
