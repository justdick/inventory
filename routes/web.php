<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceiptController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $products = Product::all();
    return view('all_product', compact('products'));
})->middleware(['auth'])->name('all_product');

require __DIR__.'/auth.php';


Route::group(['middleware' => ['auth']], function () {
    Route::resources([
        'product'=> ProductController::class,
        'order' => OrderController::class,
        'receipt' => ReceiptController::class,
    ]);

    Route::get('print_receipt', [ReceiptController::class, 'print_receipt']);
    Route::post('/receipt/create', [ReceiptController::class, 'check'])->name('receipt.check');
});


Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/stock/create/{product}', [StockController::class ,'create'])->name('stock.create');
    Route::resource('stock', StockController::class)->except(['create']);

    Route::resources([
        'user' => UserController::class,
        'sales' => SalesController::class,
    ]);

    Route::post('/sales/details', [SalesController::class, 'sales_details'])->name('sales_details');
    Route::post('/sales/search', [SalesController::class, 'search'])->name('sales_search');
    Route::get('/reports/monthly', [ReportController::class, 'monthly_index'])->name('monthly_index');
    Route::post('/reports/monthly/{month}', [ReportController::class, 'monthly'])->name('month');
    Route::get('/reports/yearly', [ReportController::class, 'yearly_index'])->name('yearly_index');
    Route::post('/reports/yearly/{year}', [ReportController::class, 'yearly'])->name('year');
});
