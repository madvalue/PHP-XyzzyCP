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

Route::get("/", "MainController@main");
Route::get("/error", "MainController@error");

// Characters
Route::get("/characters", "CharactersController@list");
Route::get("/characters/new", "CharactersController@new");
Route::post("/characters/new", "CharactersController@new_process");
Route::get("/characters/{charid}", "CharactersController@details");

// Login
Route::get("/login", "LoginController@show");
Route::post("/login/process", "LoginController@process");

// Register
Route::get("/register", "RegisterController@show");
Route::post("/register/process", "RegisterController@process");

// Logout
Route::get("/logout", "MainController@logout");