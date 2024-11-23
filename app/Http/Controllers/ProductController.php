<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtén todos los productos 
        $product = Product::all(); 
        // Devuelve los datos en formato JSON 
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'name' => 'required|string', // Cambia según tus necesidades
            'description' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
        ]);

        // Crear un nuevo registro en la base de datos
        $data = Product::create($validatedData);

        // Retornar una respuesta
        return response()->json([
            'message' => 'Datos guardados con éxito',
            'data' => $data,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
