<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ {{ isset($noticia) ? 'Editar Noticia' : 'Crear Nueva Noticia' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ isset($noticia) ? route('noticias.update', $noticia) : route('noticias.store') }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($noticia))
                            @method('PUT')
                        @endif

                        <!-- Título -->
                        <div class="mb-6">
                            <label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">Título *</label>
                            <input type="text" id="titulo" name="titulo" 
                                   value="{{ old('titulo', $noticia->titulo ?? '') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required maxlength="255">
                            @error('titulo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Entradilla -->
                        <div class="mb-6">
                            <label for="entradilla" class="block text-sm font-medium text-gray-700 mb-2">Entradilla *</label>
                            <textarea id="entradilla" name="entradilla" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      required maxlength="500">{{ old('entradilla', $noticia->entradilla ?? '') }}</textarea>
                            <p class="text-sm text-gray-500 mt-1">Máximo 500 caracteres. Aparecerá como resumen.</p>
                            @error('entradilla')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cuerpo -->
                        <div class="mb-6">
                            <label for="cuerpo" class="block text-sm font-medium text-gray-700 mb-2">Cuerpo de la Noticia *</label>
                            <textarea id="cuerpo" name="cuerpo" rows="10"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      required>{{ old('cuerpo', $noticia->cuerpo ?? '') }}</textarea>
                            @error('cuerpo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SEO -->
                        <div class="mb-6">
                            <label for="seo" class="block text-sm font-medium text-gray-700 mb-2">Descripción SEO</label>
                            <textarea id="seo" name="seo" rows="2"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      maxlength="160">{{ old('seo', $noticia->seo ?? '') }}</textarea>
                            <p class="text-sm text-gray-500 mt-1">Máximo 160 caracteres. Para motores de búsqueda.</p>
                            @error('seo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Categoría -->
                            <div>
                                <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-2">Categoría *</label>
                                <select id="categoria_id" name="categoria_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        required>
                                    <option value="">Seleccionar categoría</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id_categoria }}"
                                                {{ old('categoria_id', $noticia->categoria_id ?? '') == $categoria->id_categoria ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha y Hora de Publicación -->
                            <div>
                                <label for="fecha_publicacion" class="block text-sm font-medium text-gray-700 mb-2">Fecha y Hora de Publicación</label>
                                <input type="datetime-local" id="fecha_publicacion" name="fecha_publicacion"
                                       value="{{ old('fecha_publicacion', isset($noticia->fecha_publicacion) ? $noticia->fecha_publicacion->format('Y-m-d\TH:i') : '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <p class="text-sm text-gray-500 mt-1">Dejar vacío para publicar inmediatamente.</p>
                                @error('fecha_publicacion')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Imagen Destacada (CAMBIADO: imagen_portada → imagen_destacada) -->
                        <div class="mb-6">
                            <label for="imagen_destacada" class="block text-sm font-medium text-gray-700 mb-2">Imagen Destacada</label>
                            <input type="file" id="imagen_destacada" name="imagen_destacada"
                                   accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="text-sm text-gray-500 mt-1">Formatos: JPG, PNG, GIF. Máximo 2MB.</p>
                            @if(isset($noticia) && $noticia->imagen_destacada)
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600">Imagen actual:</p>
                                    <img src="{{ asset('storage/' . $noticia->imagen_destacada) }}" 
                                         alt="Imagen actual" class="mt-1 w-32 h-32 object-cover rounded">
                                </div>
                            @endif
                            @error('imagen_destacada')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-between items-center">
                            <a href="{{ route('noticias.mis-noticias') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                ← Volver
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">
                                💾 {{ isset($noticia) ? 'Actualizar Noticia' : 'Crear Noticia' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>