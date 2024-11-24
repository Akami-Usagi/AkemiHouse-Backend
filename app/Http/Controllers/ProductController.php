<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'name' => 'required|string', // Cambia según tus necesidades
            'description' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $destinationPath = public_path('storage/products');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $path = 'storage/products/' . $filename;
        } else {
            $path = null;
        }
        

        // Crear un nuevo registro en la base de datos
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image_path' => $path,
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
        $product = Product::find($id);

        // Si no existe, retorna un error 404
        if (!$product) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        // Retorna la categoría en formato JSON
        return response()->json($product, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{

        dd($request->all());

        // Validar los datos del request
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:10240', // La imagen es opcional
        ]);

        // Buscar el producto por ID
        $product = Product::findOrFail($id);

        // Manejar la imagen
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($product->image_path && Storage::exists($product->image_path)) {
                Storage::delete($product->image_path);
            }

            // Guardar la nueva imagen
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image_path = $imagePath;
        }

        // Actualizar los datos
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

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
    public function destroy(Product $product)
    {
        //
    }
}
