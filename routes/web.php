<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\PartController;
use App\Http\Controllers\Api\BlockController;
use App\Http\Controllers\Api\ProjectController;
use Inertia\Inertia;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('cache.token')->group(function () {

    Route::get('/reports', [ReportController::class, 'reports'])->name('reports');

    // Listado de partes (GET)
    Route::get('/parts', [PartController::class, 'index'])->name('parts.index');
    
    // Formulario de creación (GET)
    Route::get('/parts/create', [PartController::class, 'create'])->name('parts.create');
    
    // Guardar nueva parte (POST)
    Route::post('/parts', [PartController::class, 'store'])->name('parts.store');
    
    // Mostrar detalle de parte (GET)
    Route::get('/parts/{part}', [PartController::class, 'show'])->name('parts.show');
    
    // Formulario de edición (GET)
    Route::get('/parts/{part}/edit', [PartController::class, 'edit'])->name('parts.edit');
    
    // Actualizar parte (PUT/PATCH)
    Route::put('/parts/{part}', [PartController::class, 'update'])->name('parts.update');
    Route::patch('/parts/{part}', [PartController::class, 'update']);

     // Mostrar detalle de parte (GET)
    Route::delete('/parts/{part}', [PartController::class, 'destroy'])->name('parts.delete');

    Route::get('parts/block/{blockId}', [PartController::class, 'getPartsByBlock'])
         ->name('parts.by-block');



    // Listar todos los bloques (GET)
    Route::get('/blocks', [BlockController::class, 'index'])->name('blocks.index');
    
    // Mostrar formulario de creación (GET)
    Route::get('/blocks/create', [BlockController::class, 'create'])->name('blocks.create');
    
    // Guardar nuevo bloque (POST)
    Route::post('/blocks', [BlockController::class, 'store'])->name('blocks.store');
    
    // Mostrar detalle de un bloque (GET)
    Route::get('/blocks/{block}', [BlockController::class, 'show'])->name('blocks.show');
    
    // Mostrar formulario de edición (GET)
    Route::get('/blocks/{block}/edit', [BlockController::class, 'edit'])->name('blocks.edit');
    
    // Actualizar bloque (PUT/PATCH)
    Route::put('/blocks/{block}', [BlockController::class, 'update'])->name('blocks.update');
    Route::patch('/blocks/{block}', [BlockController::class, 'update']);
    
    // Eliminar bloque (DELETE)
    Route::delete('/blocks/{block}', [BlockController::class, 'destroy'])->name('blocks.destroy');
    
    // Bloques por proyecto (GET)
    Route::get('/blocks/project/{projectId}', [BlockController::class, 'getByProject'])
         ->name('blocks.by-project');



    // Listar todos los proyectos (GET)
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    
    // Mostrar formulario de creación (GET)
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    
    // Guardar nuevo proyecto (POST)
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    
    // Mostrar detalle de un proyecto (GET)
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    
    // Mostrar formulario de edición (GET)
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    
    // Actualizar proyecto (PUT/PATCH)
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::patch('/projects/{project}', [ProjectController::class, 'update']);
    
    // Eliminar proyecto (DELETE)
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});

/*
Route::middleware(['auth', 'cache.token'])->group(function () {
    Route::resource('parts', PartController::class);
    Route::get('parts/block/{blockId}', [PartController::class, 'getPartsByBlock'])
         ->name('parts.by-block');
});*/