<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;

Route::get('/', function () {
    $categorias = \App\Models\Categoria::orderBy('orden')->get();
    return view('inicio', compact('categorias'));
})->name('inicio');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== RUTAS PROTEGIDAS POR ROLES ====================

// Solo administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/panel', function () {
        return "🔐 PANEL DE ADMINISTRADOR - Solo visible para administradores";
    })->name('admin.panel');
    
    Route::get('/admin/usuarios', function () {
        return "👥 GESTIÓN DE USUARIOS - Solo administradores";
    })->name('admin.usuarios');
});

// Administradores y periodistas - GESTIÓN DE NOTICIAS (UN SOLO GRUPO)
Route::middleware(['auth', 'journalist'])->group(function () {
    // Rutas del controlador de noticias
    Route::get('/noticias/crear', [NoticiaController::class, 'create'])->name('noticias.create');
    Route::post('/noticias', [NoticiaController::class, 'store'])->name('noticias.store');
    Route::get('/mis-noticias', [NoticiaController::class, 'index'])->name('noticias.mis-noticias');
    Route::get('/noticias/{noticia}/editar', [NoticiaController::class, 'edit'])->name('noticias.edit');
    Route::put('/noticias/{noticia}', [NoticiaController::class, 'update'])->name('noticias.update');
    Route::delete('/noticias/{noticia}', [NoticiaController::class, 'destroy'])->name('noticias.destroy');
});

// Ruta pública de ejemplo para visitantes
Route::get('/noticias', function () {
    return "📰 NOTICIAS PÚBLICAS - Todos los visitantes pueden ver";
})->name('noticias.publicas');

require __DIR__.'/auth.php';