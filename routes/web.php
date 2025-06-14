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

     //Reportes
    Route::get('/reports', [ReportController::class, 'reports'])->name('reports');

    
    // Partes
    Route::get('/parts', [PartController::class, 'index'])->name('parts.index');
    Route::get('/parts/create', [PartController::class, 'create'])->name('parts.create');
    Route::post('/parts', [PartController::class, 'store'])->name('parts.store');
    Route::get('/parts/{part}', [PartController::class, 'show'])->name('parts.show');
    Route::get('/parts/{part}/edit', [PartController::class, 'edit'])->name('parts.edit');
    Route::put('/parts/{part}', [PartController::class, 'update'])->name('parts.update');
    Route::patch('/parts/{part}', [PartController::class, 'update']);
    Route::delete('/parts/{part}', [PartController::class, 'destroy'])->name('parts.delete');

    Route::get('parts/block/{blockId}', [PartController::class, 'getPartsByBlock'])
         ->name('parts.by-block');


    // Bloques
    Route::get('/blocks', [BlockController::class, 'index'])->name('blocks.index');
    Route::get('/blocks/create', [BlockController::class, 'create'])->name('blocks.create');
    Route::post('/blocks', [BlockController::class, 'store'])->name('blocks.store');
    Route::get('/blocks/{block}', [BlockController::class, 'show'])->name('blocks.show');
    Route::get('/blocks/{block}/edit', [BlockController::class, 'edit'])->name('blocks.edit');
    Route::put('/blocks/{block}', [BlockController::class, 'update'])->name('blocks.update');
    Route::patch('/blocks/{block}', [BlockController::class, 'update']);
    Route::delete('/blocks/{block}', [BlockController::class, 'destroy'])->name('blocks.destroy');
    
    Route::get('/blocks/project/{projectId}', [BlockController::class, 'getByProject'])
         ->name('blocks.by-project');


    // Proyectos
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::patch('/projects/{project}', [ProjectController::class, 'update']);
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});
