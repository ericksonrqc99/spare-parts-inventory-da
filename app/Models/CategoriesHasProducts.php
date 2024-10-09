<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesHasProducts extends Model
{
    use HasFactory;
    protected $table = 'categories_has_products';

    protected $fillable = [
        'categories_id',
        'products_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
