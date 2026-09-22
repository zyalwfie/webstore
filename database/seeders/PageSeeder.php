<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'name' => 'Syarat & Ketentuan',
                'slug' => 'syarat-ketentuan',
                'content' => <<<'MD'
Dengan mengakses dan menggunakan Webstore, kamu menyetujui syarat dan ketentuan berikut. Mohon dibaca dengan saksama sebelum melakukan pembelian.

## 1. Penggunaan Layanan

Webstore menyediakan produk digital (kelas video dan ebook) serta produk fisik (buku cetak) untuk keperluan belajar pribadi. Kamu tidak diperkenankan menggandakan, menjual kembali, atau menyebarluaskan materi tanpa izin tertulis dari kami.

## 2. Akun & Keamanan

Kamu bertanggung jawab menjaga kerahasiaan data akunmu. Segala aktivitas yang terjadi melalui akunmu menjadi tanggung jawabmu. Segera hubungi kami jika terjadi penggunaan yang tidak sah.

## 3. Pembelian & Pembayaran

Seluruh harga tercantum dalam Rupiah dan sudah termasuk pajak yang berlaku. Pesanan dianggap sah setelah pembayaran terverifikasi. Pesanan yang tidak dibayar hingga batas waktu akan dibatalkan secara otomatis.

## 4. Hak Kekayaan Intelektual

Seluruh materi, logo, dan konten di Webstore merupakan milik kami dan dilindungi undang-undang hak cipta. Pembelian memberimu hak untuk mengakses materi, bukan hak kepemilikan atasnya.

## 5. Perubahan Ketentuan

Kami dapat memperbarui syarat dan ketentuan ini sewaktu-waktu. Perubahan berlaku sejak dipublikasikan di halaman ini. Penggunaan layanan secara berkelanjutan berarti kamu menyetujui ketentuan yang diperbarui.

Jika ada pertanyaan seputar ketentuan ini, silakan hubungi kami melalui halaman kontak.
MD,
            ],
            [
                'name' => 'Kebijakan Privasi',
                'slug' => 'kebijakan-privasi',
                'content' => <<<'MD'
Privasimu penting bagi kami. Kebijakan ini menjelaskan bagaimana Webstore mengumpulkan, menggunakan, dan melindungi data pribadimu.

## 1. Data yang Kami Kumpulkan

Kami mengumpulkan data yang kamu berikan secara langsung, seperti nama, alamat email, nomor telepon, dan alamat pengiriman ketika kamu membuat pesanan atau menghubungi kami.

## 2. Bagaimana Kami Menggunakan Data

Data kamu kami gunakan untuk:

- Memproses pesanan dan pengiriman produk
- Memberikan dukungan pelanggan
- Mengirim informasi penting seputar transaksimu
- Mengirim materi promosi, hanya jika kamu berlangganan newsletter

## 3. Keamanan Data

Kami menerapkan langkah pengamanan teknis dan organisasi yang wajar untuk melindungi data pribadimu dari akses yang tidak sah. Data pembayaran diproses melalui kanal yang aman dan terenkripsi.

## 4. Berbagi Data dengan Pihak Ketiga

Kami tidak menjual data pribadimu. Data hanya dibagikan kepada mitra tepercaya yang membantu operasional kami, seperti penyedia jasa pengiriman dan pembayaran, sebatas yang diperlukan.

## 5. Hak Kamu

Kamu berhak mengakses, memperbaiki, atau meminta penghapusan data pribadimu. Untuk itu, silakan hubungi kami melalui halaman kontak.

Dengan menggunakan Webstore, kamu menyetujui kebijakan privasi ini.
MD,
            ],
            [
                'name' => 'Pengiriman & Retur',
                'slug' => 'pengiriman-retur',
                'content' => <<<'MD'
Halaman ini menjelaskan cara kami mengirimkan produk serta ketentuan pengembalian dana.

## 1. Produk Digital

Kelas video dan ebook dapat diakses atau diunduh langsung setelah pembayaran terverifikasi. Tidak ada biaya pengiriman untuk produk digital.

## 2. Produk Fisik

Buku cetak dikirim melalui kurir mitra kami: JNE, J&T Express, SiCepat, ID Express, dan Ninja Express. Ongkos kirim dihitung otomatis saat checkout berdasarkan alamat tujuan dan berat produk.

Estimasi waktu pengiriman:

- Jawa: 2–4 hari kerja
- Luar Jawa: 3–7 hari kerja

Nomor resi akan kami berikan setelah pesanan dikirim sehingga kamu bisa melacaknya.

## 3. Garansi 30 Hari

Kami memberikan garansi kepuasan 30 hari. Jika materi tidak sesuai harapan, kamu dapat mengajukan pengembalian dana dalam 30 hari sejak tanggal pembelian.

## 4. Cara Mengajukan Retur

Hubungi tim kami melalui halaman kontak dengan menyertakan nomor pesananmu dan alasan pengembalian. Setelah disetujui, dana akan kami kembalikan ke rekening asal dalam 3–7 hari kerja.

## 5. Ketentuan

Produk fisik yang diretur harus dalam kondisi baik dan belum rusak. Ongkos kirim pengembalian ditanggung pembeli, kecuali kesalahan berasal dari pihak kami.
MD,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
