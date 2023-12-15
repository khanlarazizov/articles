<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ProtocolController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CompanyController;

Route::resource('contracts', ContractController::class);
Route::get('contracts/{contracts}/download', [ContractController::class, 'download'])->name('contracts.download');

Route::resource('protocols', ProtocolController::class);
Route::get('protocols/{id}/download', [ProtocolController::class, 'download'])->name('protocols.download');

Route::resource('companies', CompanyController::class)->except(['show']);


Route::resource('companies.projects', ProjectController::class);
//Route::resource('projects.folders', FolderController::class);
Route::resource('companies.projects.folders', FolderController::class);
//Route::resource('projects.folders', FolderController::class)->except(['show']);






//Route::resource('projects', ProjectController::class)->except(['show', 'update']);

//Route::prefix('folder')->controller(FolderController::class)->group(function (){
//    Route::get('index','index')->name('folder.index');
//    Route::get('index/{id:folders}','folder')->name('folder');
//
//    Route::get('create','create')->name('folder.create');
//    Route::post('store','store')->name('folder.store');
//
//    Route::get('edit/{id}','edit')->name('folder.edit');
//    Route::post('update/{id}','update')->name('folder.update');
//
//    Route::delete('delete/{id}','delete')->name('folder.delete');
//});
