<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductResultController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\HistoriesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.pages.login');
});

Route::get('/home', function () {
    return view('auth.pages.login');
});

Route::post('/get-satuan', [ProductController::class, 'getSatuan']);
Route::post('/get-satuan-product', [ProductResultController::class, 'get_satuan_product']);

Route::get('/login', [AuthController::class, 'login'])->name('login.index');
Route::post('/login', [AuthController::class, 'loginStore'])->name('login');

Route::middleware('guest')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'admin']);
    Route::get('/dashboard', [HomeController::class, 'scan1']);
    Route::get('/', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'registerStore'])->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // ============ ADMIN =============
    Route::prefix('admin')->middleware('roleAs:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.pages.dashboard');
        })->name('admin.dashboard');

        Route::get('/admin/transaksi', [TransaksiController::class, 'index_admin'])->name('admin.transaksi.index');
        Route::put('transaksi/{transaksi}', [TransaksiController::class, 'update_admin'])->name('admin.transaksi.update');
        Route::get('admin/transaksi/create', [TransaksiController::class, 'createadmin'])->name('admin.transaksi.create');
        Route::post('admin/transaksi/store', [TransaksiController::class, 'storeadmin'])->name('admin.transaksi.store');
        Route::delete('transaksi/{transaksi}', [TransaksiController::class, 'destroy_two'])->name('admin.transaksi.destroy');

        //Route scan
        Route::get('scan', [ScanController::class, 'indexscan'])->name('admin.scan.index');
        Route::post('scan', [ScanController::class, 'scann'])->name('scann.process');
        // Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('staff.transaksi.create');
        // Route::post('/transaksi', [TransaksiController::class, 'store'])->name('staff.transaksi.store');

        //route histories
        Route::get('/histories', [HistoriesController::class, 'index_admin'])->name('admin.histories.index');

        // Paket routes
        Route::get('/paket', [PaketController::class, 'index_admin'])->name('admin.paket.index');
        Route::get('/paket/create', [PaketController::class, 'create'])->name('admin.paket.create');
        Route::post('/paket', [PaketController::class, 'store'])->name('admin.paket.store');
        Route::get('/get-paket/{id}', [TransaksiController::class, 'getPaket'])->name('admin.paket.getPaket'); // Named route

        Route::prefix('users')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('admin.users');
            Route::get('/create', [UsersController::class, 'create'])->name('admin.users.create');
            Route::post('/store', [UsersController::class, 'store'])->name('admin.users.store');
            Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
            Route::put('/{id}/update', [UsersController::class, 'update'])->name('admin.users.update');
            Route::delete('/{id}/destroy', [UsersController::class, 'destroy'])->name('admin.users.destroy');
        });
    });

    // ============ SCAN1 =============
    Route::prefix('scan1')->middleware('roleAs:scan1')->group(function () {
        Route::get('/dashboard', function () {
            return view('scan1.pages.dashboard');
        })->name('scan1.dashboard');

        Route::get('scan', [ScanController::class, 'scan_one'])->name('scan1.scan.index');
        Route::post('/scan', [ScanController::class, 'scan_satu'])->name('scan1.scan.process');

        Route::get('/histories', [HistoriesController::class, 'index'])->name('staff.histories.index');
        Route::post('/histories/update/{id}', [HistoriesController::class, 'update'])->name('histories.update');
        Route::post('/histories/update-qty/{id}', [HistoriesController::class, 'updateQty'])->name('histories.updateQty');
    });

    Route::prefix('scan2')->middleware('roleAs:scan2')->group(function () {
        Route::get('/dashboard', function () {
            return view('scan2.pages.dashboard');
        })->name('scan2.dashboard');

        Route::get('scan', [ScanController::class, 'scan_two'])->name('scan2.scan.index');
        Route::post('/scan', [ScanController::class, 'scan_dua'])->name('scan2.scan.process');

        Route::get('/histories', [HistoriesController::class, 'index'])->name('staff.histories.index');
        Route::post('/histories/update/{id}', [HistoriesController::class, 'update'])->name('histories.update');
        Route::post('/histories/update-qty/{id}', [HistoriesController::class, 'updateQty'])->name('histories.updateQty');
    });

    Route::prefix('scan3')->middleware('roleAs:scan3')->group(function () {
        Route::get('/dashboard', function () {
            return view('scan3.pages.dashboard');
        })->name('scan3.dashboard');

        Route::get('scan', [ScanController::class, 'scan_three'])->name('scan3.scan.index');
        Route::post('/scan', [ScanController::class, 'scan_dua'])->name('scan3.scan.process');

        Route::get('/histories', [HistoriesController::class, 'index'])->name('staff.histories.index');
        Route::post('/histories/update/{id}', [HistoriesController::class, 'update'])->name('histories.update');
        Route::post('/histories/update-qty/{id}', [HistoriesController::class, 'updateQty'])->name('histories.updateQty');
    });


    Route::get('staff/checkTransaksi/{barcode}', [TransaksiController::class, 'checkTransaksi'])->name('staff.transaksi.checkTransaksi');

    Route::post('staff/histories/store', [HistoriesController::class, 'store'])->name('staff.histories.store');

    // ============ STAFF =============
    Route::prefix('staff')->middleware('roleAs:staff')->group(function () {
        Route::get('/dashboard', function () {
            return view('staff.pages.dashboard');
        })->name('staff.dashboard');

        // Categories routes
        Route::get('categories', [CategoryController::class, 'index'])->name('staff.categories.index');
        Route::get('categories/create', [CategoryController::class, 'create'])->name('staff.categories.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('staff.categories.store');
        Route::get('categories/{categories}/edit', [CategoryController::class, 'edit'])->name('staff.categories.edit');
        Route::put('categories/{categories}', [CategoryController::class, 'update'])->name('staff.categories.update');
        Route::delete('categories/{categories}', [CategoryController::class, 'destroy'])->name('staff.categories.destroy');

        // Scan routes
        Route::get('scan', [ScanController::class, 'index'])->name('staff.scan.index');
        Route::post('/scan', [ScanController::class, 'scan'])->name('staff.scan.process');
        Route::get('/scan-form', [ScanController::class, 'showScanForm'])->name('staff.scan.form');
        // Route::post('/scan/process', [ScanController::class, 'scan'])->name('scan.process');
        Route::get('/histories', [HistoriesController::class, 'index'])->name('staff.histories.index');
        Route::post('/histories/update/{id}', [HistoriesController::class, 'update'])->name('histories.update');
        Route::post('/histories/update-qty/{id}', [HistoriesController::class, 'updateQty'])->name('histories.updateQty');



        // Transaksi routes
        Route::get('/transaksi', [TransaksiController::class, 'index'])->name('staff.transaksi.index');
        Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('staff.transaksi.create');
        Route::post('/transaksi', [TransaksiController::class, 'store'])->name('staff.transaksi.store');
        Route::delete('transaksi/{transaksi}', [TransaksiController::class, 'destroy'])->name('staff.transaksi.destroy');
        Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('staff.transaksi.show');
        Route::post('/staff/transaksi/sendMessage', [TransaksiController::class, 'sendWhatsAppMessage'])->name('staff.transaksi.sendWhatsApp');
        Route::post('/staff/transaksi/sendMessageWithBarcode', [TransaksiController::class, 'sendWhatsAppMessageWithBarcode'])->name('staff.transaksi.sendMessageWithBarcode');
        // Paket routes
        Route::get('/paket', [PaketController::class, 'index'])->name('staff.paket.index');
        Route::get('/paket/create', [PaketController::class, 'create'])->name('staff.paket.create');
        Route::post('/paket', [PaketController::class, 'store'])->name('staff.paket.store');
        Route::get('/get-paket/{id}', [TransaksiController::class, 'getPaket'])->name('staff.paket.getPaket'); // Named route

        // Product routes
        Route::get('product', [ProductController::class, 'index'])->name('staff.product.index');
        Route::get('product/create', [ProductController::class, 'create'])->name('staff.product.create');
        Route::post('product', [ProductController::class, 'store'])->name('staff.product.store');
        Route::get('product/{product}/edit', [ProductController::class, 'edit'])->name('staff.product.edit');
        Route::put('product/{product}', [ProductController::class, 'update'])->name('staff.product.update');
        Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('staff.product.destroy');

        // History routes
        Route::resource('history', HistoryController::class);
    });


    // ============ SCAN2 =============

});
