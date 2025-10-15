<!DOCTYPE html>
<html>
<head>
    <title>Canal UTV - Noticias</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
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

    <!-- USAR EL COMPONENTE DE CATEGORÍAS -->
    <x-categorias-nav />

    <main class="container mx-auto p-6">
        <div class="text-center py-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Bienvenido a Canal UTV</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Tu fuente confiable de noticias sobre el Área Metropolitana, Santander, cultura, deportes y actualidad nacional.
            </p>
        </div>
    </main>

    <footer class="bg-gray-800 text-white p-6 mt-12">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Canal UTV. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>