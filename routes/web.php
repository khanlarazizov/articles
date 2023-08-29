<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\contractController;


Route::get('contract.index', [contractController::class, 'index'])->name('contract.index');
Route::get('contract.fetch', [contractController::class, 'fetch'])->name('contract.fetch');

Route::post('contract.store', [contractController::class, 'store'])->name('contract.store');

Route::get('contract.edit.{id}', [contractController::class, 'edit'])->name('contract.edit');
Route::post('contract.update.{id}', [contractController::class, 'update'])->name('contract.update');

Route::delete('contract.delete.{id}', [contractController::class, 'delete'])->name('contract.delete');
