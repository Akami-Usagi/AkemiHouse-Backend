<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtén todos las categorias 
        $categories = Category::all(); 
        // Devuelve los datos en formato JSON 
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         // Encuentra la categoría por ID
        $category = Category::find($id);

        // Si no existe, retorna un error 404
        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        // Retorna la categoría en formato JSON
        return response()->json($category, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
