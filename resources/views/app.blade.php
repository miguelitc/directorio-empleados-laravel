<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorio Corporativo</title>
    
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav class="bg-blue-800 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('empleados.index') }}" class="text-white text-xl font-bold tracking-wide">
                Sistema De Gestión de Empleados
            </a>
        </div>
    </nav>

    <main class="container mx-auto mt-8 px-4">
        @yield('content')
    </main>

</body>
</html>