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

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

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
        
        Route::post('/search-by-number',[App\Http\Controllers\Account\VehicleController::class, 'searchByNumber'])->name('searchByNumber');
        
    });

    Route::get('/polls/vote', [App\Http\Controllers\Account\PollController::class, 'index'])->name('poll.vote');
    Route::get('/polls/survey', [App\Http\Controllers\Account\PollController::class, 'index'])->name('poll.survey');
    Route::get('/polls/{id}', [App\Http\Controllers\Account\PollController::class, 'show'])->name('poll.show');
    Route::post('/polls/{id}', [App\Http\Controllers\Account\PollController::class, 'submit'])->name('poll.submit');

    // Notifications Routes
    Route::group(['prefix' => 'notifications', 'as' => 'notifications.'], function () {

        Route::get('/', [App\Http\Controllers\Account\NotificationController::class, 'index'])->name('index');
        Route::post('/{id}/read', [App\Http\Controllers\Account\NotificationController::class, 'markAsRead'])->name('read');
        Route::post('/read', [App\Http\Controllers\Account\NotificationController::class, 'markAllAsRead'])->name('read.all');
    });

    // Transactions Routes
    Route::group(['prefix' => 'transactions', 'as' => 'transactions.'], function () {

        Route::get('/', [App\Http\Controllers\Account\TransactionController::class, 'index'])->name('index');
    });


    Route::get('/serivce-types/{id}', [App\Http\Controllers\Account\ServiceTypeController::class, 'show'])->name('service-type.show');
    
    // Applications Routes
    Route::group(['prefix' => 'application', 'as' => 'application.'], function () {
        Route::get('/', [App\Http\Controllers\Account\ApplicationController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Account\ApplicationController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Account\ApplicationController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\Account\ApplicationController::class, 'edit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\Account\ApplicationController::class, 'update'])->name('update');
        Route::get('/{id}', [App\Http\Controllers\Account\ApplicationController::class, 'show'])->name('show');
        Route::get('/{application}/download/{media}', [App\Http\Controllers\Account\ApplicationController::class, 'download'])->name('download');
    });
    
    // Profile Routes
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', [App\Http\Controllers\Account\ProfileController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Account\ProfileController::class, 'update'])->name('update');
        Route::delete('/session',[App\Http\Controllers\Account\ProfileController::class, 'deleteSession'])->name('session.delete');
        Route::delete('/sessions',[App\Http\Controllers\Account\ProfileController::class, 'deleteOtherSessions'])->name('sessions.delete');
        Route::post('/change-password', [App\Http\Controllers\Account\ProfileController::class, 'changePassword'])->name('change_password');
    });
    
    // Məlumat masası
    Route::group(['prefix' => 'information', 'as' => 'information.'], function () {
        Route::get('/',[App\Http\Controllers\Account\InformationController::class, 'index'])->name('index');
    });

});

Route::get('/', function () {
    return redirect()->route('account.dashboard');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
