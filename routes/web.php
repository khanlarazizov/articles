<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ProtocolController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;


Route::view('/','welcome')->name('home');

Route::get('contracts/{contract}/download', [ContractController::class, 'download'])->name('contracts.download');
Route::resource('contracts', ContractController::class);

Route::get('protocols/{protocol}/download', [ProtocolController::class, 'download'])->name('protocols.download');
Route::resource('protocols', ProtocolController::class);

Route::resource('companies', CompanyController::class)->except(['show']);

Route::resource('companies.projects', ProjectController::class)->except(['show']);

Route::resource('companies.projects.folders', FolderController::class)->except(['show']);

Route::resource('users', UserController::class)->except(['show']);
