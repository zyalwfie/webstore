<?php

use App\Data\SalesOrderData;
use App\Http\Controllers\ProductController;
use App\Livewire\AboutPage;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use App\Livewire\ContactPage;
use App\Livewire\FaqPage;
use App\Livewire\HomePage;
use App\Livewire\PageStatic;
use App\Livewire\ProductCatalog;
use App\Livewire\SalesOrderDetail;
use App\Mail\SalesOrderCompletedMail;
use App\Models\SalesOrder;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('beranda');
Route::get('/katalog', ProductCatalog::class)->name('katalog');
Route::get('/produk/{product:slug}', [ProductController::class, 'show'])->name('produk');
Route::get('/keranjang', Cart::class)->name('keranjang');
Route::get('/pembayaran', Checkout::class)->name('pembayaran');
Route::get('/konfirmasi-pesanan/{sales_order:trx_id}', SalesOrderDetail::class)->name('konfirmasi-pesanan');
Route::get('/tentang', AboutPage::class)->name('tentang');
Route::get('/kontak', ContactPage::class)->name('kontak');
Route::get('/tanya-jawab', FaqPage::class)->name('tanya-jawab');
Route::get('/halaman/{page:slug?}', PageStatic::class)->name('halaman');

Route::get('/mailable', function() {

    return new SalesOrderCompletedMail(
        SalesOrderData::from(
            SalesOrder::latest()->first()
        )
    );
});

Route::webhooks('moota/callback');
