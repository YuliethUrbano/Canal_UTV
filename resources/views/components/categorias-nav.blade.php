@if($categorias->count() > 0)
<div class="bg-white shadow-sm py-6">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Categorías de Noticias</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($categorias as $categoria)
            <a href="/categoria/{{ $categoria->slug }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white p-6 rounded-lg text-center transition duration-300 transform hover:scale-105 shadow-md">
                <div class="text-lg font-semibold">{{ $categoria->nombre }}</div>
                <div class="text-sm opacity-90 mt-2">{{ $categoria->descripcion }}</div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif