<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sku', 'description', 'price', 'cost', 'minimum_stock', 'stock', 'alert_stock', 'generic_use', 'brands_id', 'suppliers_id', 'measurement_units_id', 'status'];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brands_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'suppliers_id');
    }

    public function measurementUnit()
    {
        return $this->belongsTo(MeasurementUnit::class, 'measurement_units_id');
    }

    public function characteristics()
    {
        return $this->belongsToMany(Characteristic::class, 'products_has_characteristics', 'products_id', 'characteristics_id')
            ->withPivot('value');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_has_products', 'products_id', 'categories_id');
    }

    public function modelCars()
    {
        return $this->belongsToMany(ModelCar::class, 'products_has_model_cars', 'products_id', 'model_cars_id');
    }
}
