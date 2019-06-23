<?php

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

// Route::get('/', function () {
    // return view('welcome');
// });
Route::get('/', function () {
    $items = \App\Item::orderBy('order')->get();
	return view('item', compact('items'));
});
Route::post('/reOrder', function (Illuminate\Http\Request $request) {
	$items = $request->all();
	foreach($items as $item) {
		\App\Item::where('id', $item['id'])->update(['order' => $item['order']]);
	}
	return $request->all();
});
