<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPackagingController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemUomMappingController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PackagingController;
use App\Http\Controllers\UomController;
use App\Models\PackagingType;
use App\Models\Uom;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::resource('item-packaging', ItemPackagingController::class);
Route::post('/ajax/add-item', [ItemPackagingController::class, 'ajaxAddItem'])->name('ajax.addItem');
Route::post('/ajax/add-packaging', [ItemPackagingController::class, 'ajaxAddPackaging'])->name('ajax.addPackaging');
Route::post('/item-packaging/save', [ItemPackagingController::class, 'store'])->name('itemPackaging.store');

Route::get('/item-packaging/create', [ItemPackagingController::class, 'create'])->name('itemPackaging.create');

Route::post('/ajax/addUOM', [ItemUomMappingController::class, 'ajaxAddUOM'])->name('ajax.addUOM');
Route::post('/ajax-add-new-item', [ItemPackagingController::class, 'ajaxAddItem'])->name('ajax.addNewItem');
Route::post('/ajax-add-packaging', [ItemPackagingController::class, 'ajaxAddPackaging'])->name('ajax.addPackaging');

Route::post('/ajax/edit-item', [ItemPackagingController::class, 'ajaxEditItem'])->name('ajax.edit.item');
Route::post('/ajax/edit-packaging', [ItemPackagingController::class, 'ajaxEditPackaging'])->name('ajax.edit.packaging');
Route::post('/ajax/edit-uom', [ItemPackagingController::class, 'ajaxEditUom'])->name('ajax.edit.uom');

Route::middleware(['auth'])->group(function () {
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::post('/items/save', [ItemController::class, 'saveItem'])->name('items.save');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/item-uom-mappings/create', [ItemUomMappingController::class, 'create'])->name('item-uom-mappings.create');
    Route::post('/item-uom-mappings', [ItemUomMappingController::class, 'store'])->name('item-uom-mappings.store');
});

Route::get('/client', function () {
    return view('client.index');
});

Route::get('/firm', function () {
    return view('firm.index');
});

Route::get('/register', function () {
    return view('auth.register');
});
