<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ProtocolController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;


//Route::view('/','welcome')->name('home');

Route::get('/', [CompanyController::class, 'index'])->name('home');


//Route::get('contracts/{contract}/download', [ContractController::class, 'download'])->name('contracts.download');
Route::resource('contracts', ContractController::class);

//Route::get('protocols/{protocol}/download', [ProtocolController::class, 'download'])->name('protocols.download');
Route::resource('protocols', ProtocolController::class);

Route::resource('companies', CompanyController::class)->except(['show']);

Route::resource('companies.projects', ProjectController::class)->except(['show']);

Route::resource('companies.projects.folders', FolderController::class)->except(['show']);

Route::resource('users', UserController::class)->except(['show']);

//Route::resource('documents', DocumentController::class);

Route::prefix('documents')->name('documents.')->controller(DocumentController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/contracts/create', 'createContract')->name('contracts.create');
    Route::get('/contract-additions/create', 'createContractAddition')->name('contract-additions.create');
    Route::get('/protocols/create', 'createProtocol')->name('protocols.create');
    Route::get('/delivery-statements/create', 'createDeliveryStatement')->name('delivery-statement.create');



    Route::post('/store', [DocumentController::class, 'store'])->name('store');
});

Route::post('/get-addition',[DocumentController::class,'getAddition'])->name('get.addition');


Route::delete('documents/{id}', [DocumentController::class, 'destroy']);
