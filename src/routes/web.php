<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ChargeController;

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


Route::middleware('auth')->group(function () {
    Route::get('/', [ShopController::class, 'index']);
    Route::post('/favorite/add',[CustomerController::class, 'addFavo']);
    Route::post('/favorite/delete',[CustomerController::class, 'deleteFavo']);
    Route::get('/mypage', [CustomerController::class, 'mypage']);
    Route::post('/mypage/review', [CustomerController::class, 'review']);
    Route::get('/detail/{shop_id}', [ShopController::class, 'shopDetail']);
    Route::post('/reserve/make',[ReserveController::class, 'makeReserve']);
    Route::get('/reserve/done',[ReserveController::class, 'done']);
    Route::post('/reserve/update',[ReserveController::class, 'updateReserve']);
    Route::post('/reserve/delete',[ReserveController::class, 'deleteReserve']);
    Route::post('/charge',[ChargeController::class, 'charge']);
});

Route::group(['middleware'=>['auth','can:isAdmin']],function (){
    Route::get('/admin', [AdminController::class, 'admin']);
    Route::post('/admin/createuser',[AdminController::class, 'createUser']);
    Route::post('/admin/updateuser',[AdminController::class, 'updateUser']);
    Route::post('/admin/addEditor',[AdminController::class, 'addEditor']);
    Route::post('/admin/deleditor',[AdminController::class, 'delEditor']);
    Route::post('/admin/createshop',[AdminController::class, 'createShop']);
    Route::post('/mail', [MailController::class,'send']);
});

Route::group(['middleware'=>['auth','can:isEditor']],function (){
    Route::get('/edit', [EditController::class, 'edit']);
    Route::post('/edit/update', [EditController::class, 'update']);
});


require __DIR__.'/auth.php';

