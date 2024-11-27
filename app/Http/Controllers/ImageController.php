<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'path' => "required|string",
        ]);

        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $destinationPath = public_path('storage/' . $request->path);
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $path = 'products/' . $filename;
        } else {
            $path = null;
        }
        

        // Crear un nuevo registro en la base de datos
        $image = Image::create([
            'image_path' => $path,
        ]);

        

        //Retornar una respuesta
        return response()->json([
            'message' => 'Datos guardados con éxito',
            'data' => $image,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         // Encuentra la categoría por ID
        $image = Image::find($id);

        // Si no existe, retorna un error 404
        if (!$image) {
            return response()->json(['message' => 'Imagen no encontrada'], 404);
        }

        // Retorna la categoría en formato JSON
        return response()->json($image, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         // Encuentra el producto por ID
        $image = Image::findOrFail($id);

         // Ruta absoluta del archivo en public/storage
        $filePath = public_path('storage/' . $image->image_path);

        // Verifica si el archivo existe antes de eliminarlo
        if (file_exists($filePath)) {
            unlink($filePath); // Elimina el archivo
        }

        // Eliminar el producto de la base de datos
        $image->delete();

        // Retornar una respuesta exitosa
        return response()->json(['message' => 'Imagen eliminada satisfactoriamente']);
    }
}
