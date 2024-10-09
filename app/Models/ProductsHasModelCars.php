<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsHasModelCars extends Model
{
    use HasFactory;
    protected $table = 'products_has_model_cars';

    protected $fillable = [
        'model_cars_id',
        'products_id',
    ];

    public function model_car()
    {
        return $this->belongsTo(ModelCar::class, 'model_cars_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
