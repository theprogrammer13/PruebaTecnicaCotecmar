<?php
/*
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PartController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\BlockController;
use App\Http\Controllers\Api\ReportController;
*/

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas API para tu aplicación.
|
*/

/*
// Autenticación pública
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas
Route::middleware('auth.api')->group(function () {
    // Gestión de autenticación
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // Piezas
    Route::get('/parts', [PartController::class, 'index']);
    Route::post('/parts', [PartController::class, 'store']);
    Route::get('/parts/{id}', [PartController::class, 'show']);
    Route::put('/parts/{id}', [PartController::class, 'update']);
    Route::delete('/parts/{id}', [PartController::class, 'destroy']);
    Route::get('/blocks/{blockId}/parts', [PartController::class, 'getPartsByBlock']);

    // Projects
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

    // Blocks
    Route::get('/blocks', [BlockController::class, 'index']);
    Route::post('/blocks', [BlockController::class, 'store']);
    Route::get('/blocks/{id}', [BlockController::class, 'show']);
    Route::put('/blocks/{id}', [BlockController::class, 'update']);
    Route::delete('/blocks/{id}', [BlockController::class, 'destroy']);
    Route::get('/projects/{projectId}/blocks', [BlockController::class, 'getByProject']);
    
    // Reportes
    Route::get('/reports/pending-parts', [ReportController::class, 'pendingParts']);
    Route::get('/reports/project-status', [ReportController::class, 'projectStatus']);
});
*/