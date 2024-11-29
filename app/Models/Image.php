<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['image_path']; // Ajusta según tu modelo

    public function products()
    {
        return $this->hasMany(Image::class, 'image_id', 'id');
    }
}

