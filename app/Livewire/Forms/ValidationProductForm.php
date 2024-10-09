<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ValidationProductForm extends Form
{

    #[Validate('required|max:100')]
    public $sku;

    #[Validate('required|max:100')]
    public $name;

    #[Validate('nullable|max:255')]
    public $description;

    #[Validate('required|numeric')]
    public $price;

    #[Validate('required|numeric')]
    public $cost;

    #[Validate('required|numeric')]
    public $minimum_stock = 1;

    #[Validate('required|numeric')]
    public $stock;

    #[Validate('required|numeric|in:1,0')]
    public $alert_stock = 1;

    #[Validate('required|numeric')]
    public $brands_id;

    #[Validate('required|numeric')]
    public $suppliers_id;

    #[Validate('required|numeric')]
    public $measurement_units_id;

    #[Validate('required|numeric|in:1,0')]
    public $status = 1;
}
