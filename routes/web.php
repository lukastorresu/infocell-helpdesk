<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TipoChamadoController;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController; // Importe o novo controller
use App\Http\Middleware\IsAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Nossas rotas de CRUD
	Route::get('/clientes/search', [ClienteController::class, 'search'])->name('clientes.search');
    Route::resource('clientes', ClienteController::class);
    Route::resource('tipos-chamado', TipoChamadoController::class);
    Route::resource('chamados', ChamadoController::class);
    Route::get('/chamados/{chamado}/pdf', [ChamadoController::class, 'generatePDF'])->name('chamados.pdf');
    
    // Rota de gerenciamento (Admin)
    Route::resource('usuarios', UserController::class)
        ->parameters(['usuarios' => 'user'])
        ->except(['create', 'store', 'show'])
        ->middleware(IsAdmin::class)
        ->names('users');

    // Novas rotas de Perfil (para o usuário logado)
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('perfil.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('perfil.update');
});


require __DIR__.'/auth.php';
