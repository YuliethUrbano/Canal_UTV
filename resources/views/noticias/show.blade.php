<!DOCTYPE html>
<html>
<head>
    <title>{{ $noticia->titulo }} - Canal UTV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="description" content="{{ $noticia->seo ?? $noticia->entradilla }}">
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-blue-800 text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div>
                <a href="{{ route('inicio') }}" class="text-3xl font-bold hover:text-blue-200 transition">Canal UTV</a>
                <p class="text-blue-200">Noticias de Santander y Colombia</p>
            </div>
            <nav class="space-x-4">
                <a href="{{ route('inicio') }}" class="hover:text-blue-200 transition">Inicio</a>
                <a href="{{ route('login') }}" class="bg-white text-blue-800 px-4 py-2 rounded-lg font-semibold hover:bg-blue-100 transition">
                    Iniciar Sesión
                </a>
            </nav>
        </div>
    </header>

    <!-- Noticia Completa -->
    <main class="container mx-auto p-6 max-w-4xl">
        <article class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Imagen destacada -->
            @if($noticia->imagen_destacada)
                <img src="{{ asset('storage/' . $noticia->imagen_destacada) }}" 
                     alt="{{ $noticia->titulo }}" 
                     class="w-full h-64 md:h-96 object-cover">
            @endif

            <!-- Contenido de la noticia -->
            <div class="p-8">
                <!-- Encabezado -->
                <div class="mb-6">
                    <!-- Categoría -->
                    <div class="mb-4">
                        <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $noticia->categoria->nombre }}
                        </span>
                    </div>
                    
                    <!-- Título -->
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                        {{ $noticia->titulo }}
                    </h1>
                    
                    <!-- Metadatos -->
                    <div class="flex flex-wrap items-center text-gray-600 text-sm mb-6">
                        <div class="flex items-center mr-6 mb-2">
                            <span class="mr-1">✍️</span>
                            <span>Por: {{ $noticia->usuario->nombre }}</span>
                        </div>
                        <div class="flex items-center mr-6 mb-2">
                            <span class="mr-1">📅</span>
                            <span>Publicado: {{ $noticia->fecha_publicacion->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="mr-1">👁️</span>
                            <span>{{ $noticia->visitas }} visitas</span>
                        </div>
                    </div>
                </div>

                <!-- Entradilla -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8">
                    <p class="text-lg text-gray-700 italic">{{ $noticia->entradilla }}</p>
                </div>

                <!-- Cuerpo de la noticia -->
                <div class="prose max-w-none mb-8">
                    {!! $noticia->cuerpo !!}
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('inicio') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                        ← Volver al inicio
                    </a>
                    <div class="flex space-x-4">
                        <!-- Botones para compartir (puedes agregar funcionalidad después) -->
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            📤 Compartir
                        </button>
                    </div>
                </div>
            </div>
        </article>

        <!-- Noticias relacionadas (puedes implementar después) -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">📰 Más noticias de {{ $noticia->categoria->nombre }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Aquí irían noticias relacionadas de la misma categoría -->
                <div class="text-center py-8 text-gray-500">
                    <p>Próximamente: noticias relacionadas</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white p-6 mt-12">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Canal UTV. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>