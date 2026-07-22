<!-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Empleado</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 40px; }
        .card { background: white; max-width: 500px; margin: 0 auto; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #1f2937; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; color: #4b5563; font-weight: bold; }
        input { width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 4px; box-sizing: border-box; }
        .btn { background-color: #2563eb; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; }
        .btn:hover { background-color: #1d4ed8; }
        .error { color: #dc2626; font-size: 0.85em; margin-top: 5px; }
    </style>
</head>
<body>

<div class="card">
    <h2>Registrar Nuevo Empleado</h2>

    <form action="{{ route('empleados.store') }}" method="POST">
        
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
            @error('nombre') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos') }}">
            @error('apellidos') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" value="{{ old('correo') }}">
            @error('correo') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="puesto">Puesto:</label>
            <input type="text" id="puesto" name="puesto" value="{{ old('puesto') }}">
            @error('puesto') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="salario">Salario Mensual:</label>
            <input type="number" step="0.01" id="salario" name="salario" value="{{ old('salario') }}">
            @error('salario') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn">Guardar Empleado</button>
    </form>
</div>

</body>
</html> -->