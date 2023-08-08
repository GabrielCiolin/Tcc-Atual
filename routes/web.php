<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Promise\Create;
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


Route::get('/', [LoginController::class, 'index'])->name('login.login');

Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'authenticate')->name('login');
    Route::get('/login/{erro?}', 'index')->name('login.index');
    // Route::get('/logout', 'logout')->name('login.logout');



});


Route::middleware('authentication')->controller(ClientController::class)->group(function () {

    Route::get('/client/search', 'index')->name('client.index');

    Route::get('/client/add', 'create'); //criar um cliente
    Route::post('/client', 'store'); // enviar o post

    Route::get('/client/edit/{id}', 'edit'); //para editar um cliente
    Route::put('/client/update/{id}', 'update'); // para subir os dados atualizados no banco

    Route::get('/client/delete/{id}', 'destroy'); // Cria a rota de deleção de cliente como parâmetro o ID
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');


    Route::middleware('admin')->controller(UserController::class)->group(function () {

        Route::get('/user/search', 'index')->name('user.index');

        Route::get('/user/add', 'create')->name('user.create');
        Route::post('/user', 'store');

        Route::get('/user/edit/{id}', 'edit');
        Route::put('/user/update/{id}', 'update'); 

        Route::get('/user/delete/{id}', 'destroy'); 
    });
});





// Route::controller(ClientController::class)->group(function () {

//     Route::get('/client/search', 'index');
    
//     Route::get('/client/add', 'create'); //criar um cliente
//     Route::post('/client', 'store'); // enviar o post
  
//     Route::get('/client/edit/{id}', 'edit'); //para editar um cliente
//     Route::put('/client/update/{id}', 'update'); // para subir os dados atualizados no banco

//     Route::get('/client/delete/{id}', 'destroy'); // Cria a rota de deleção de cliente como parâmetro o ID


// });
