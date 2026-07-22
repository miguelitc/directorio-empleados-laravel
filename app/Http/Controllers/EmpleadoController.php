<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::all(); // Recuperamos todos los empleados de la base de datos
        // Retornamos la vista y le inyectamos la variable $empleados
        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      // BUENAS PRÁCTICAS: Reglas de validación antes de tocar la base de datos
    $datosValidados = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'correo' => 'required|email|unique:empleados,correo',
        'puesto' => 'required|string|max:255',
        'salario' => 'required|numeric|min:0',
    ]);

    // =================================================================
    // OPCIÓN A: Usando Eloquent ORM (Orientado a Objetos - Recomendado)
    // =================================================================
    Empleado::create($datosValidados);

    // =================================================================
    // OPCIÓN B: Usando SQL Crudo / Directo (Nativo)
    // =================================================================
    /*
    DB::insert('INSERT INTO empleados (nombre, apellidos, correo, puesto, salario, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?)', [
        $request->nombre,
        $request->apellidos,
        $request->correo,
        $request->puesto,
        $request->salario,
        now(), // timestamp actual
        now()
    ]);
    */

//    return redirect()->route('empleados.index');
   // Al final del método store...
    return redirect()->route('empleados.index')->with('success', '¡Empleado registrado correctamente!');
}

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    // Buscamos al empleado por su ID, si no existe lanza un 404
    $empleado = Empleado::findOrFail($id);

    return view('empleados.edit', compact('empleado'));
}

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $empleado = Empleado::findOrFail($id);

    // Validamos (ojo a la regla del correo: le decimos que ignore el correo de ESTE empleado para que no marque error de duplicado)
    $datosValidados = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'correo' => 'required|email|unique:empleados,correo,' . $empleado->id,
        'puesto' => 'required|string|max:255',
        'salario' => 'required|numeric|min:0',
    ]);

    // Eloquent hace el UPDATE automáticamente
    $empleado->update($datosValidados);

    // return redirect()->route('empleados.index');
    // Al final del método update...
    return redirect()->route('empleados.index')->with('success', '¡Empleado actualizado correctamente!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $empleado = Empleado::findOrFail($id);
    
    // Eloquent hace el DELETE
    $empleado->delete();

    // return redirect()->route('empleados.index');
    // Al final del método destroy...
    return redirect()->route('empleados.index')->with('success', '¡Registro eliminado del sistema!');
}
}
