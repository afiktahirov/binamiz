<?php

use Illuminate\Support\Facades\Route;
use App\Exports\VehiclesExport;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
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


Route::get('/test-export-all', function () {
    $allIds = \App\Models\Vehicle::pluck('id')->toArray();
    return Excel::download(new \App\Exports\VehiclesExport($allIds), 'all_vehicles.xlsx');
});

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth'], 'prefix' => 'account', 'as' => 'account.'], function () {
    
    Route::get('/dashboard', function () {
        return view('account.dashboard');
    })->name('dashboard');
    
    // Garage Routes
    Route::group(['prefix' => 'garage', 'as' => 'garage.'], function () {
        Route::get('/', [App\Http\Controllers\Account\GarageController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\Account\GarageController::class, 'detail'])->name('detail');
    });
    
    // Object Routes
    Route::group(['prefix' => 'object', 'as' => 'object.'], function () {
        Route::get('/', [App\Http\Controllers\Account\ObjectController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\Account\ObjectController::class, 'detail'])->name('detail');
    });

    // Apartments Routes
    Route::group(['prefix' => 'apartment', 'as' => 'apartment.'], function () {
        Route::get('/', [App\Http\Controllers\Account\ApartmentController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\Account\ApartmentController::class, 'detail'])->name('detail');
    });
    
    // Vehicles Routes
    Route::group(['prefix' => 'vehicle', 'as' => 'vehicle.'], function () {
        Route::get('/', [App\Http\Controllers\Account\VehicleController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\Account\VehicleController::class, 'detail'])->name('detail');
    });

});

Route::get('/', function () {
    return redirect()->route('account.dashboard');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
