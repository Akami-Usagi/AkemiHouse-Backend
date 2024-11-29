<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name']; // Ajusta según tu modelo

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
