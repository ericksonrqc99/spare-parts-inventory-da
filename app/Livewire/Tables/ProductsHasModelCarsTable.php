<?php

namespace App\Livewire\Tables;

use App\Models\ModelCar;
use App\Models\Product;
use LivewireUI\Modal\ModalComponent;

class ProductsHasModelCarsTable extends ModalComponent
{
    public $currentProductId;
    public $currentModelCarId;
    public $modelCarsList;

    public function mount()
    {
        // Get current product id of session
        $this->currentProductId = session('currentProductId', null);
        if (empty($this->currentProductId)) {
            $this->closeModal();
            $this->dispatch("sweet-alert", icon: "error", title: __('El producto no existe'));
        }
        //Get all model cars
        $this->modelCarsList = ModelCar::all();
        // If the modelCarsList is not empty, assign the ID of the first model car to currentModelCarId
        if (!$this->modelCarsList->isEmpty()) {
            $this->currentModelCarId = $this->modelCarsList->first()->id;
        }
    }

    public function render()
    {
        return view('livewire.tables.products-has-model-cars-table');
    }

    public function addModelCarToProduct()
    {
        // TODO: add service for verify existing product
        $product = Product::find($this->currentProductId);
        if ($product) {
            $isLinked = $product->modelCars()->where('model_cars.id', $this->currentModelCarId)->exists();
            if ($isLinked) {
                $this->dispatch("sweet-alert", icon: "info", title: __('El modelo ya está agregado'));
            } else {
                $product->modelCars()->attach($this->currentModelCarId);
            }
            $this->dispatch("reload-table-ProductsHasModelCarsTable");
        } else {
            $this->dispatch("sweet-alert", icon: "error", title: __('El producto no existe o está desactivado'));
        }
    }
}
