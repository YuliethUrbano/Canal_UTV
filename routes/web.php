<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Administradores y periodistas
Route::middleware(['auth', 'journalist'])->group(function () {
    Route::get('/noticias/crear', function () {
        return "📝 CREAR NOTICIA - Visible para administradores y periodistas";
    })->name('noticias.crear');
    
    Route::get('/mis-noticias', function () {
        return "📰 MIS NOTICIAS - Panel del periodista";
    })->name('noticias.mis-noticias');
});

// Ruta pública de ejemplo para visitantes
Route::get('/noticias', function () {
    return "📰 NOTICIAS PÚBLICAS - Todos los visitantes pueden ver";
})->name('noticias.publicas');

require __DIR__.'/auth.php';