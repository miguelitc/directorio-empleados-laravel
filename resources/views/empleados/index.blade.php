@extends('app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Directorio de Empleados</h2>
        <button onclick="abrirModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 cursor-pointer shadow-lg hover:shadow-xl">
            + Nuevo Empleado
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <section class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left border-b">ID</th>
                    <th class="py-3 px-6 text-left border-b">Nombre Completo</th>
                    <th class="py-3 px-6 text-left border-b">Correo</th>
                    <th class="py-3 px-6 text-left border-b">Puesto</th>
                    <th class="py-3 px-6 text-left border-b">Salario</th>
                    <th class="py-3 px-6 text-center border-b">Acciones</th>
                </tr>
            </section>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($empleados as $empleado)
                <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $empleado->id }}</td>
                    <td class="py-3 px-6 text-left font-semibold">{{ $empleado->nombre }} {{ $empleado->apellidos }}</td>
                    <td class="py-3 px-6 text-left">{{ $empleado->correo }}</td>
                    <td class="py-3 px-6 text-left">
                        <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-xs">{{ $empleado->puesto }}</span>
                    </td>
                    <td class="py-3 px-6 text-left font-medium text-green-600">${{ number_format($empleado->salario, 2) }}</td>
                    
                    <td class="py-3 px-6 text-center flex justify-center space-x-2">
                        <button onclick="abrirModalEditar(this)" 
                                data-id="{{ $empleado->id }}"
                                data-nombre="{{ $empleado->nombre }}"
                                data-apellidos="{{ $empleado->apellidos }}"
                                data-correo="{{ $empleado->correo }}"
                                data-puesto="{{ $empleado->puesto }}"
                                data-salario="{{ $empleado->salario }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded shadow text-xs font-bold transition duration-300 cursor-pointer">
                            Editar
                        </button>                        
                            @csrf
                            @method('DELETE')
                        <button onclick="abrirModalEliminar(this)" 
                                data-id="{{ $empleado->id }}"
                                data-nombre="{{ $empleado->nombre }} {{ $empleado->apellidos }}"
                                class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded shadow text-xs font-bold transition duration-300 cursor-pointer">
                            Eliminar
                        </button>                  
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@if(session('success'))
    <div id="toastSuccess" class="fixed bottom-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-xl flex items-center gap-3 z-50 transition-opacity duration-500 opacity-100">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span class="font-semibold">{{ session('success') }}</span>
    </div>

    <script>
        setTimeout(function() {
            const toast = document.getElementById('toastSuccess');
            if (toast) {
                // Primero aplicamos la clase para que se desvanezca suavemente
                toast.classList.replace('opacity-100', 'opacity-0');
                // Medio segundo después, lo quitamos por completo del HTML
                setTimeout(() => toast.remove(), 500);
            }
        }, 3000); // 3000 milisegundos = 3 segundos
    </script>
@endif

//modal para crear
<div id="modalCrear" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 overflow-y-auto h-full w-full flex items-center justify-center transition-all duration-300">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md relative transform scale-100 transition-transform">
        <button onclick="cerrarModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Registrar Empleado</h2>
        <form action="{{ route('empleados.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre:</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Ej. Juan">
                @error('nombre') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Apellidos:</label>
                <input type="text" name="apellidos" value="{{ old('apellidos') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Ej. Pérez">
                @error('apellidos') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Correo:</label>
                <input type="email" name="correo" value="{{ old('correo') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="correo@empresa.com">
                @error('correo') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Puesto:</label>
                <input type="text" name="puesto" value="{{ old('puesto') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Ej. Desarrollador">
                @error('puesto') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Salario:</label>
                <input type="number" step="0.01" name="salario" value="{{ old('salario') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="0.00">
                @error('salario') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="cerrarModal()" class="px-5 py-2 text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition">Cancelar</button>
                <button type="submit" class="px-5 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold shadow-md transition">Guardar</button>
            </div>
        </form>
    </div>
</div>
//modal para editar
<div id="modalEditar" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 overflow-y-auto h-full w-full flex items-center justify-center transition-all duration-300">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md relative">
        <button onclick="cerrarModalEditar()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Modificar Empleado</h2>
        <form id="formEditar" action="" method="POST">
            @csrf
            @method('PUT') 
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre:</label>
                <input type="text" id="edit_nombre" name="nombre" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Apellidos:</label>
                <input type="text" id="edit_apellidos" name="apellidos" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Correo:</label>
                <input type="email" id="edit_correo" name="correo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Puesto:</label>
                <input type="text" id="edit_puesto" name="puesto" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Salario:</label>
                <input type="number" step="0.01" id="edit_salario" name="salario" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="cerrarModalEditar()" class="px-5 py-2 text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition">Cancelar</button>
                <button type="submit" class="px-5 py-2 text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg font-semibold shadow-md transition">Actualizar</button>
            </div>
        </form>
    </div>
</div>

//modal para eliminar
<div id="modalEliminar" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 overflow-y-auto h-full w-full flex items-center justify-center transition-all duration-300">
    <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-sm relative transform scale-100 transition-transform">
        
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>

        <h2 class="text-xl font-bold text-gray-900 text-center mb-2">¿Confirmar Eliminación?</h2>
        <p class="text-sm text-gray-500 text-center mb-6">
            Estás a punto de eliminar a <span id="eliminar_nombre" class="font-bold text-gray-800"></span>. Esta acción no se puede deshacer y se borrará permanentemente de MySQL.
        </p>

        <form id="formEliminar" action="" method="POST">
            @csrf
            @method('DELETE')
            
            <div class="flex justify-center gap-3">
                <button type="button" onclick="cerrarModalEliminar()" class="px-4 py-2 text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition cursor-pointer">
                    Cancelar
                </button>
                <button type="submit" class="px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg font-semibold shadow-md transition cursor-pointer">
                    Eliminar Registro
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // --- Lógica Modal Crear ---
    const modalCrear = document.getElementById('modalCrear');

    function abrirModal() {
        modalCrear.classList.remove('hidden');
    }

    function cerrarModal() {
        modalCrear.classList.add('hidden');
    }

    // --- Lógica Modal Editar ---
    const modalEditar = document.getElementById('modalEditar');
    const formEditar = document.getElementById('formEditar');

    function abrirModalEditar(button) {
        const id = button.getAttribute('data-id');
        
        document.getElementById('edit_nombre').value = button.getAttribute('data-nombre');
        document.getElementById('edit_apellidos').value = button.getAttribute('data-apellidos');
        document.getElementById('edit_correo').value = button.getAttribute('data-correo');
        document.getElementById('edit_puesto').value = button.getAttribute('data-puesto');
        document.getElementById('edit_salario').value = button.getAttribute('data-salario');
        
        formEditar.action = `/empleados/${id}`;
        modalEditar.classList.remove('hidden');
    }

    function cerrarModalEditar() {
        modalEditar.classList.add('hidden');
    }

    // --- Lógica Modal Eliminar ---
    const modalEliminar = document.getElementById('modalEliminar');
    const formEliminar = document.getElementById('formEliminar');
    const eliminarNombre = document.getElementById('eliminar_nombre');

    function abrirModalEliminar(button) {
        // 1. Extraemos los atributos cargados en la fila
        const id = button.getAttribute('data-id');
        const nombreCompleto = button.getAttribute('data-nombre');
        
        // 2. Inyectamos textualmente el nombre en el párrafo del modal
        eliminarNombre.textContent = nombreCompleto;
        
        // 3. Modificamos la ruta de acción del formulario para que apunte al ID correcto
        formEliminar.action = `/empleados/${id}`;
        
        // 4. Encendemos el modal quitando la clase 'hidden'
        modalEliminar.classList.remove('hidden');
    }

    function cerrarModalEliminar() {
        modalEliminar.classList.add('hidden');
    }

    // --- Lógica de Errores ---
    @if($errors->any())
        document.addEventListener("DOMContentLoaded", function() {
            abrirModal(); // Por ahora solo abrimos el de crear si hay un error general
        });
    @endif
</script>

@endsection