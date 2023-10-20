<?php

use App\Models\Type;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;

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
    return redirect('/dashboard');
});
Route::get('/dashboard', function () {
    $types = Type::all();
    $data['arrayTypes'] = [];
    $data['arrayCounts'] = [];
    foreach ($types as $value) {
        $data['arrayTypes'][] = $value->name;
        $data['arrayCounts'][] = Vehicle::where('type_id', $value->id)->count();
    }
    $data['countTotal'] = array_sum($data['arrayCounts']);
    return view('dashboard', $data);
});
