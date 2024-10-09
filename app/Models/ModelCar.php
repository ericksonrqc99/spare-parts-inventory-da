<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCar extends Model
{
    use HasFactory;

    protected $table = 'model_cars';

    protected $fillable = [
        'name',
        'brands_id',
        'year',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brands_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_has_model_cars');
    }
}
