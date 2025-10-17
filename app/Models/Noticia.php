<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $table = 'noticias';
    protected $primaryKey = 'id_noticia';

    protected $fillable = [
        'titulo',
        'ruta_slug', // ← Cambiado de 'slug'
        'entradilla',
        'cuerpo',
        'seo',
        'fecha_publicacion',
        'imagen_destacada', // ← Cambiado de 'imagen_portada'
        'estado', // ← Cambiado de 'publicada'
        'categoria_id',
        'autor_id', // ← Cambiado de 'usuario_id'
    ];

    protected $casts = [
        'fecha_publicacion' => 'datetime',
    ];

    // Relación con categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id_categoria');
    }

    // Relación con usuario (periodista/administrador) - CAMBIADO
    public function usuario()
    {
        return $this->belongsTo(User::class, 'autor_id', 'id_usuario');
    }

    // Generar slug automáticamente desde el título
    public static function boot()
    {
        parent::boot();

        static::creating(function ($noticia) {
            $noticia->ruta_slug = \Illuminate\Support\Str::slug($noticia->titulo);
        });

        static::updating(function ($noticia) {
            $noticia->ruta_slug = \Illuminate\Support\Str::slug($noticia->titulo);
        });
    }
}