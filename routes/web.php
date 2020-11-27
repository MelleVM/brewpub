<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// Route::get('/orders/waiter', [OrderController::class, 'index'])->name('orders.waiter');
Route::get('/orders/view/{view}', [OrderController::class, 'index'])->name('orders');
Route::get('/orders/create/{table_id}', [OrderController::class, 'create'])->name('orders.create');
Route::get('/orders/{id}', [OrderController::class, 'edit'])->name('orders.edit');
Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
Route::delete('/orders/{id}', [OrderController::class, 'delete'])->name('orders.delete');
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');


Route::get('/insert-json-file-to-database-table', function(){
	$json = file_get_contents(storage_path('/app/public/images/db.json'));
	$objs = json_decode($json,true);
	foreach ($objs as $obj)  {	
		foreach ($obj as $key => $value) {
			if($key == "fields") {
				$value['coordinates'] = implode(', ', $value['coordinates']);
				$insertArr[str_slug($key,'_')] = $value;
			}
		}
		DB::table('products')->insert($insertArr);
	}
	dd("Finished adding data in drinks table");
});