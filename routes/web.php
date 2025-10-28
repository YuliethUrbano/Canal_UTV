<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// ==================== RUTAS PÚBLICAS ====================

// Ruta principal - Página de inicio
Route::get('/', function () {
    $categorias = \App\Models\Categoria::orderBy('orden')->get();
    $noticias = \App\Models\Noticia::where('estado', 'publicado')
                ->where('fecha_publicacion', '<=', now())
                ->orderBy('fecha_publicacion', 'desc')
                ->take(6) 
                ->get();
    
    return view('inicio', compact('categorias', 'noticias'));
})->name('inicio');

// Ruta para ver una noticia individual (pública)
Route::get('/noticia/{slug}', function ($slug) {
    $noticia = \App\Models\Noticia::where('ruta_slug', $slug)
                ->where('estado', 'publicado')
                ->where('fecha_publicacion', '<=', now())
                ->firstOrFail();
    
    return view('noticias.show', compact('noticia'));
})->name('noticia.show');

// Ruta pública de ejemplo para visitantes
Route::get('/noticias', function () {
    return "📰 NOTICIAS PÚBLICAS - Todos los visitantes pueden ver";
})->name('noticias.publicas');

// ==================== RUTAS DE AUTENTICACIÓN ====================

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
    Route::get('/admin/panel', [AdminController::class, 'panel'])->name('admin.panel');
    Route::get('/admin/moderar-noticias', [AdminController::class, 'moderarNoticias'])->name('admin.moderar-noticias');
    Route::get('/admin/gestion-usuarios', [AdminController::class, 'gestionUsuarios'])->name('admin.gestion-usuarios');
    Route::post('/admin/noticias/{noticia}/aprobar', [AdminController::class, 'aprobarNoticia'])->name('admin.noticias.aprobar');
    Route::post('/admin/noticias/{noticia}/rechazar', [AdminController::class, 'rechazarNoticia'])->name('admin.noticias.rechazar');
    Route::post('/admin/usuarios/{usuario}/toggle', [AdminController::class, 'toggleUsuario'])->name('admin.usuarios.toggle');
});

// Administradores y periodistas - GESTIÓN DE NOTICIAS
Route::middleware(['auth', 'journalist'])->group(function () {
    Route::get('/noticias/crear', [NoticiaController::class, 'create'])->name('noticias.create');
    Route::post('/noticias', [NoticiaController::class, 'store'])->name('noticias.store');
    Route::get('/mis-noticias', [NoticiaController::class, 'index'])->name('noticias.mis-noticias');
    Route::get('/noticias/{noticia}/editar', [NoticiaController::class, 'edit'])->name('noticias.edit');
    Route::put('/noticias/{noticia}', [NoticiaController::class, 'update'])->name('noticias.update');
    Route::delete('/noticias/{noticia}', [NoticiaController::class, 'destroy'])->name('noticias.destroy');
});

require __DIR__.'/auth.php';