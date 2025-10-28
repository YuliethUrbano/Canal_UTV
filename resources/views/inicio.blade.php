<!DOCTYPE html>
<html>
<head>
    <title>Canal UTV - Noticias</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-blue-800 text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Canal UTV</h1>
                <p class="text-blue-200">Noticias de Santander y Colombia</p>
            </div>
            <nav class="space-x-4">
                <a href="{{ route('login') }}" class="bg-white text-blue-800 px-4 py-2 rounded-lg font-semibold hover:bg-blue-100 transition">
                    Iniciar Sesión
                </a>
            </nav>
        </div>
    </header>

    <!-- Componente de categorías -->
    <x-categorias-nav />

    <!-- Noticias Recientes -->
    <main class="container mx-auto p-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Noticias Recientes</h2>
        
        @if($noticias->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($noticias as $noticia)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <!-- Imagen de la noticia -->
                    @if($noticia->imagen_destacada)
                        <img src="{{ asset('storage/' . $noticia->imagen_destacada) }}" 
                             alt="{{ $noticia->titulo }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">📷 Sin imagen</span>
                        </div>
                    @endif
                    
                    <!-- Contenido de la noticia -->
                    <div class="p-6">
                        <!-- Categoría -->
                        <div class="mb-2">
                            <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">
                                {{ $noticia->categoria->nombre }}
                            </span>
                        </div>
                        
                        <!-- Título -->
                        <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">
                            {{ $noticia->titulo }}
                        </h3>
                        
                        <!-- Entradilla -->
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $noticia->entradilla }}
                        </p>
                        
                        <!-- Fecha y autor -->
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <div>
                                📅 {{ $noticia->fecha_publicacion->format('d/m/Y') }}
                            </div>
                            <div>
                                ✍️ {{ $noticia->usuario->nombre }}
                            </div>
                        </div>
                        
                        <!-- Botón leer más -->
                        <a href="{{ route('noticia.show', $noticia->ruta_slug) }}" 
                           class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition duration-200">
                            Leer más →
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
            
            <!-- Botón ver más noticias -->
            <div class="text-center mt-12">
                <a href="{{ route('noticias.publicas') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-200">
                    Ver todas las noticias
                </a>
            </div>
            
        @else
            <!-- Estado cuando no hay noticias -->
            <div class="text-center py-12">
                <div class="mb-4">
                    <span class="text-6xl">📰</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No hay noticias publicadas aún</h3>
                <p class="text-gray-500">Nuestro equipo está trabajando en nuevo contenido</p>
            </div>
        @endif
    </main>

    <footer class="bg-gray-800 text-white p-6 mt-12">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Canal UTV. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>