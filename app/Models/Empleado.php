<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Model
{
    use HasFactory;

    // Buenas prácticas: Declaramos explícitamente qué campos se pueden llenar
    protected $fillable = [
        'nombre', 
        'apellidos', 
        'correo', 
        'puesto', 
        'salario'
    ];
}
