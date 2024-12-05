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
        $product = Product::with(["category" , "image"])->get(); 
        // Devuelve los datos en formato JSON 
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'name' => 'required|string', // Cambia según tus necesidades
            'description' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'image_id' => 'required|integer',
        ]);

        
        // Crear un nuevo registro en la base de datos
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image_id' => $request->image_id,
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
    public function show($id)
    {
         // Encuentra la categoría por ID
        $product = Product::with(["category", "image"])->find($id);

        // Si no existe, retorna un error 404
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Retorna la categoría en formato JSON
        return response()->json($product, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{

        // Validar los datos del request
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'image_id' => 'required|integer',
            
        ]);

        // Buscar el producto por ID
        $product = Product::findOrFail($id);

        
        // Actualizar los datos
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->image_id = $request->image_id;

        // Guardar los cambios
        $product->save();

        return response()->json([
            'message' => 'Producto actualizado con éxito',
            'product' => $product
        ]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         // Encuentra el producto por ID
        $product = Product::find($id);

        $image = $product->image;

        if ($image) {
            // Ruta absoluta del archivo en public/storage
            $filePath = public_path('storage/' . $image->image_path);
    
            // Verifica si el archivo existe antes de eliminarlo
            if (file_exists($filePath)) {
                unlink($filePath); // Elimina el archivo físico
            }
    
            // Elimina el registro de la imagen de la base de datos
            
        }

        // Eliminar el producto de la base de datos
        $product->delete();
        $image->delete();

        // Retornar una respuesta exitosa
        return response()->json(['message' => 'Producto eliminado con éxito']);
    }
}
