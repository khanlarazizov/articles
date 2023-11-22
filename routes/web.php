<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\contractController;
use App\Http\Controllers\protocolController;
use App\Http\Controllers\folderController;

Route::prefix('contract')->controller(contractController::class)->group(function (){
    Route::get('index','index')->name('contract.index');

    Route::get('create','create')->name('contract.create');
    Route::post('store','store')->name('contract.store');

    Route::get('edit/{id}','edit')->name('contract.edit');
    Route::put('update/{id}','update')->name('contract.update');

    Route::delete('delete/{id}','delete')->name('contract.delete');

    Route::get('download/{id}','download')->name('contract.download');
});

Route::prefix('protocol')->controller(protocolController::class)->group(function (){
    Route::get('index','index')->name('protocol.index');

    Route::get('create','create')->name('protocol.create');
    Route::post('store','store')->name('protocol.store');

    Route::get('edit/{id}','edit')->name('protocol.edit');
    Route::put('update/{id}','update')->name('protocol.update');

    Route::delete('delete/{id}','delete')->name('protocol.delete');

    Route::get('download/{id}','download')->name('protocol.download');
});


Route::prefix('folder')->controller(folderController::class)->group(function (){
    Route::get('index','index')->name('folder.index');
    Route::get('index/{slug:folders}','folder')->name('folder');

    Route::get('create','create')->name('folder.create');
    Route::post('store','store')->name('folder.store');

    Route::get('edit/{id}','edit')->name('folder.edit');
    Route::post('update/{id}','update')->name('folder.update');

    Route::delete('delete/{id}','delete')->name('folder.delete');
});
