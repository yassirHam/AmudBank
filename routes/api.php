<?php
use App\Http\Controllers\Admincontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/',[Admincontroller::class,'main'])


?>
