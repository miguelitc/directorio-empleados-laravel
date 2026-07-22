<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB; // Importamos la clase DB para SQL crudo
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // ==========================================
        // FORMA 1: SQL Crudo (Nativo)
        // ==========================================
        // $usuarios = DB::select('SELECT * FROM users LIMIT 5');

        // ==========================================
        // FORMA 2: Eloquent ORM (Orientado a Objetos)
        // ==========================================
        $usuarios = User::limit(5)->get();

        // La función dd() detiene la ejecución y te muestra los datos en pantalla
        dd($usuarios); 
    }
}