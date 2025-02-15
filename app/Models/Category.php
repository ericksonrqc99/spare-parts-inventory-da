<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'description'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'categories_has_products', 'categories_id', 'products_id');
    }
}
