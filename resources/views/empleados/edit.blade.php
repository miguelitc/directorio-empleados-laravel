<!-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 40px; }
        .card { background: white; max-width: 500px; margin: 0 auto; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #1f2937; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; color: #4b5563; font-weight: bold; }
        input { width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 4px; box-sizing: border-box; }
        .btn { background-color: #f59e0b; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; font-weight: bold; }
        .btn:hover { background-color: #d97706; }
        .error { color: #dc2626; font-size: 0.85em; margin-top: 5px; }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #4b5563; text-decoration: none; }
    </style>
</head>
<body>

<div class="card">
    <h2>Editar Empleado</h2>

    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $empleado->nombre) }}">
            @error('nombre') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos', $empleado->apellidos) }}">
            @error('apellidos') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" value="{{ old('correo', $empleado->correo) }}">
            @error('correo') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="puesto">Puesto:</label>
            <input type="text" id="puesto" name="puesto" value="{{ old('puesto', $empleado->puesto) }}">
            @error('puesto') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="salario">Salario Mensual:</label>
            <input type="number" step="0.01" id="salario" name="salario" value="{{ old('salario', $empleado->salario) }}">
            @error('salario') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn">Actualizar Cambios</button>
        <a href="{{ route('empleados.index') }}" class="back-link">Cancelar</a>
    </form>
</div>

</body>
</html> -->