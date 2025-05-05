<?php

use Illuminate\Support\Facades\Route;
use App\Exports\VehiclesExport;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-export-all', function () {
    $allIds = \App\Models\Vehicle::pluck('id')->toArray();
    return Excel::download(new \App\Exports\VehiclesExport($allIds), 'all_vehicles.xlsx');
});
