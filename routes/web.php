<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;


// Grupo utilizando o Middleware Auth para não deixar o usuario ir para essas rotas sem que
// ele esteja autenticado.

Route::middleware(['auth'])->group(function() {
    //Rota inicial 
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    //Rota de visualização
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.view');
    
    //Rotas de criação de tarefas - Middleware Auth
    Route::get('/tasks/new', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/create_action', [TaskController::class, 'create_action'])->name('tasks.create_action');

    // Criação de categoria
    Route::post('/tasks/create_categories', [TaskController::class, 'create_categories'])->name('tasks.create_categories');

    // Atualização de categoria
    Route::put('/tasks/update_categories', [TaskController::class, 'update_categories'])->name('tasks.update_categories');
    
    // acao de deletar categoria
    Route::get('/tasks/delet_categories', [TaskController::class, 'delet_categories'])->name('tasks.delet_categories');
    
    //Rotas para editar tarefas
    Route::get('/tasks/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/edit_action', [TaskController::class, 'edit_action'])->name('tasks.edit_action');
    
    //Rota para atualizar uma tarefa feita/não feita
    Route::put('/tasks/update', [TaskController::class, 'update'])->name('tasks.update');

    //Rota para deletar a tarefa
    Route::get('/tasks/delete', [TaskController::class, 'delete'])->name('tasks.delete');
    
    //logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


//Rotas de Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login_action'])->name('user.login_action');

//Rotas de registro
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_action'])->name('user.register_action');

