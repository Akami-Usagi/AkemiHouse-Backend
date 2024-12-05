<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'name' => 'required|string', // Cambia según tus necesidades
            'document' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        
        // Crear un nuevo registro en la base de datos
        $product = User::create([
            'name' => $request->name,
            'document' => $request->description,
            'phone' => $request->stock,
            'email' => $request->price,
            'password' => $request->category_id,
            'image_id' => null,
        ]);

        

        //Retornar una respuesta
        return response()->json([
            'message' => 'Datos guardados con éxito',
            'data' => $product,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
