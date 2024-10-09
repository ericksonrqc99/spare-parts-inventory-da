<?php

namespace App\Livewire\Forms;

use App\Models\Brand;
use App\Models\MeasurementUnit;
use App\Models\Product;
use App\Models\Supplier;
use LivewireUI\Modal\ModalComponent;

class ProductForm extends ModalComponent
{
    public ValidationProductForm $product;
    public $currentProductId;
    public $suppliers;
    public $characteristics = [];
    public $modelCars = [];
    public $brands;
    public $measurementUnits;

    public function mount()
    {
        session(['currentProductId' => $this->currentProductId]);
        // load all options for select inputs
        $this->loadAllSelectInputs();
        if ($this->currentProductId) {
            // Insert data in form for edit product
            $product = Product::find($this->currentProductId);
            $this->product->sku = $product->sku;
            $this->product->name = $product->name;
            $this->product->description = $product->description;
            $this->product->price = $product->price;
            $this->product->cost = $product->cost;
            $this->product->minimum_stock = $product->minimum_stock;
            $this->product->stock = $product->stock;
            $this->product->alert_stock = $product->alert_stock;
            $this->product->brands_id = $product->brands_id;
            $this->product->suppliers_id = $product->suppliers_id;
            $this->product->measurement_units_id = $product->measurement_units_id;
            $this->product->status = $product->status;
        } else {
            // Insert data in form for create product
            $this->setDefaultBrand();
            $this->setDefaultMeasurementUnit();
            $this->setDefaultSupplier();
        }
    }

    public function loadAllSelectInputs()
    {
        $this->suppliers = Supplier::all();
        $this->brands = Brand::all();
        $this->measurementUnits = MeasurementUnit::all();
    }

    public function setDefaultSupplier()
    {
        if ($this->suppliers->isNotEmpty()) {
            $this->product->suppliers_id = $this->suppliers->first()->id;
        }
    }
    public function setDefaultBrand()
    {
        if ($this->brands->isNotEmpty()) {
            $this->product->brands_id = $this->brands->first()->id;
        }
    }

    public function setDefaultMeasurementUnit()
    {
        if ($this->measurementUnits->isNotEmpty()) {
            $this->product->measurement_units_id = $this->measurementUnits->first()->id;
        }
    }

    public function submit()
    {
        $this->validate();
        try {
            ($this->currentProductId) ? $this->update() : $this->store();
            $this->dispatch("sweet-alert", icon: "success", title: "Producto guardado");
            $this->dispatch("reload-table-ProductsTable");
        } catch (\Throwable $th) {

            $this->dispatch("sweet-alert", icon: "error", title: $th);
            $this->closeModal();
        }
    }
    public function update()
    {
        $product = Product::find($this->currentProductId);
        $product->update($this->cleanData($this->product->all()));
    }
    public function store()
    {
        $product = Product::create($this->cleanData($this->product->all()));
        $this->currentProductId = $product->id;
        session(['currentProductId' => $product->id]);
    }

    public function storePivotTables(Product $product)
    {
        $product->categories()->attach($this->categories_id);
    }

    public function cleanData($array)
    {
        $cleanedData = array_map('trim', $array);
        return $cleanedData;
    }


    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function getOnlyFirstNameContact($completeName)
    {
        // Trim any extra spaces from the start and end
        $completeName = trim($completeName);
        // Check if the string is empty after trimming
        if (empty($completeName)) {
            return null; // or return '', depending on what you want
        }
        // Split the name into parts
        $nameParts = explode(' ', $completeName);
        // Get the first part
        $firstPart = $nameParts[0];
        return $firstPart;
    }
    public function render()
    {
        return view('livewire.forms.product-form');
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }
}
