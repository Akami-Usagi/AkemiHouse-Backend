<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'stock', 'price', 'category_id', 'image_id', 'image_path']; // Ajusta según tu modelo
}
