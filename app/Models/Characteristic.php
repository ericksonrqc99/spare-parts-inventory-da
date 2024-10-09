<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'description'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_has_characteristics')
            ->withPivot('value');
    }
}
