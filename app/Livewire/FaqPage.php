<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class FaqPage extends Component
{
    #[Title('Tanya Jawab — Webstore')]
    public function render()
    {
        $faqs = [
            [
                'category' => 'Umum',
                'items' => [
                    ['q' => 'Apa itu Webstore?', 'a' => 'Webstore adalah platform belajar ngoding untuk developer Indonesia. Kami menyediakan kelas video, ebook, dan proyek studi kasus yang dibuat langsung oleh praktisi di industri.'],
                    ['q' => 'Apakah materinya cocok untuk pemula?', 'a' => 'Sangat cocok. Setiap materi disusun runut dari dasar hingga mahir, menggunakan bahasa Indonesia yang mudah dipahami. Kamu tidak perlu pengalaman coding sebelumnya untuk memulai dari kelas dasar.'],
                    ['q' => 'Apakah saya mendapat sertifikat?', 'a' => 'Ya. Setelah menyelesaikan sebuah kelas, kamu akan mendapatkan sertifikat penyelesaian yang bisa kamu cantumkan di CV atau profil LinkedIn.'],
                ],
            ],
            [
                'category' => 'Pembelian & Akses',
                'items' => [
                    ['q' => 'Berapa lama saya bisa mengakses materi?', 'a' => 'Selamanya. Sekali membeli, materinya menjadi milikmu tanpa batas waktu, termasuk pembaruan materi di masa depan tanpa biaya tambahan.'],
                    ['q' => 'Bagaimana cara membeli?', 'a' => 'Pilih produk yang kamu inginkan, tambahkan ke keranjang, lalu lanjut ke checkout. Isi data pengiriman (untuk produk fisik seperti buku), pilih metode pembayaran, dan selesaikan transaksi.'],
                    ['q' => 'Apakah ebook dikirim secara fisik?', 'a' => 'Ebook dapat diunduh secara digital. Untuk buku cetak, kami mengirimkannya melalui kurir sesuai metode pengiriman yang kamu pilih saat checkout.'],
                ],
            ],
            [
                'category' => 'Pembayaran',
                'items' => [
                    ['q' => 'Metode pembayaran apa saja yang tersedia?', 'a' => 'Kami menerima transfer bank melalui BCA, Mandiri, dan BNI. Pembayaran akan diverifikasi secara otomatis setelah dana kami terima.'],
                    ['q' => 'Berapa lama batas waktu pembayaran?', 'a' => 'Setiap pesanan memiliki batas waktu pembayaran. Jika melewati batas tersebut, pesanan otomatis dibatalkan dan stok dikembalikan. Kamu bisa memesan ulang kapan saja.'],
                ],
            ],
            [
                'category' => 'Pengiriman & Retur',
                'items' => [
                    ['q' => 'Kurir apa saja yang didukung?', 'a' => 'Untuk produk fisik, kami mendukung JNE, J&T Express, SiCepat, ID Express, dan Ninja Express. Ongkir dihitung otomatis berdasarkan tujuan pengiriman kamu.'],
                    ['q' => 'Bagaimana kebijakan pengembalian dana?', 'a' => 'Kami memberikan garansi 30 hari. Jika materi tidak sesuai harapan, kamu bisa mengajukan pengembalian dana dalam 30 hari sejak pembelian. Detail selengkapnya ada di halaman Pengiriman & Retur.'],
                ],
            ],
        ];

        return view('livewire.faq-page', compact('faqs'));
    }
}
