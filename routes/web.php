<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ApiIntegrationController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HostingDomainController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\JasaCodingController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembuatanWebsiteController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\TripayPaymentController;
use App\Http\Controllers\TugasAkhirController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/tentang-kami', [IndexController::class, 'tentangKami']);
Route::get('/jasa-coding', [JasaCodingController::class, 'index'])->name('jasa.coding');
Route::get('/pembuatan-website', [PembuatanWebsiteController::class, 'index'])->name('pembuatan.website');
Route::get('/api-integration', [ApiIntegrationController::class, 'index'])->name('api.integration');
Route::get('/hosting-domain', [HostingDomainController::class, 'index'])->name('hosting.domain');
Route::get('/tugas-akhir', [TugasAkhirController::class, 'index'])->name('tugas.akhir');
Route::get('/promo', [PromoController::class, 'index'])->name('promo');
Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan');
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
Route::get('/faq', [FAQController::class, 'index'])->name('faq');
Route::get('/kontak-kami', [KontakController::class, 'index'])->name('kontak.index');
Route::post('/kontak-kami-create', [KontakController::class, 'store'])->name('kontak.store');
Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');
Route::post('/testimoni-store', [TestimoniController::class, 'store'])->name('testimoni.store');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::get('/produk/{id}', [ProdukController::class, 'index'])->name('produk.show.view');
Route::get('/produk-detail/{id}', [ProdukController::class, 'detailView'])->name('produk.detail.view');

Route::middleware(['auth'])->group(function () {
    // tripay
    Route::post('/tripay/create', [TripayPaymentController::class, 'create'])->name('tripay.create');
    Route::post('/tripay/callback', [TripayPaymentController::class, 'callback'])->name('tripay.callback');
    
    // payment
    Route::post('/payment/create', [PaymentController::class, 'createSnapToken'])->name('payment.create');
    Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

    // view payment
    Route::view('/payment/finish', 'payment.success')->name('payment.success');
    Route::view('/payment/unfinish', 'payment.unfinish')->name('payment.unfinish');
    Route::view('/payment/error', 'payment.error')->name('payment.error');
    // user
    Route::get('/riwayat-transaksi', [IndexController::class, 'riwayatTransaksi'])->name('riwayat-transaksi');
    Route::get('/profil-saya', [IndexController::class, 'akunSaya'])->name('akun-saya');
});


// ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // API untuk grafik realtime
    Route::get('/admin/dashboard/stats', [DashboardController::class, 'stats'])->name('admin.dashboard.stats');
    Route::view('/admin/subkategori', 'admin.sub-kategori')->name('admin.subkategori.view');
    Route::view('/admin/produk', 'admin.produk')->name('admin.produk.view');
    Route::view('/admin/menu', 'admin.menu')->name('admin.menu.view');

    Route::get('/users', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/users/export', [UserController::class, 'export'])->name('admin.user.export');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('admin.user.show');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');

    Route::resource('products', ProductController::class);
    Route::resource('subkategori', SubCategoryController::class)->except(['create', 'edit']);
    Route::resource('produk', ProductController::class)->except(['create', 'edit']);
    Route::resource('menu', MenuController::class)->except(['create', 'edit']);
    Route::resource('menus', MenuController::class);
    Route::get('/admin/data-transaksi', [TransaksiController::class, 'index'])->name('admin.data.transaksi');
    Route::delete('/admin/orders/{id}', [TransaksiController::class, 'destroy']);
    Route::post('/admin/orders/update-status', [TransaksiController::class, 'updateStatus']);
    Route::get('/order/{order_code}/invoice', [TransaksiController::class, 'invoice'])->name('order.invoice');
    Route::get('/admin/data-transaksi/export', [TransaksiController::class, 'export'])->name('admin.transaksi.export');
});


Route::middleware('auth')->group(function () {
    Route::get('/profil-saya', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
