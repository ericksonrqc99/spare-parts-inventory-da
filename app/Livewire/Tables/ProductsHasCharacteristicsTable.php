<?php

namespace App\Livewire\Tables;

use App\Models\Characteristic;
use App\Models\Product;
use LivewireUI\Modal\ModalComponent;

class ProductsHasCharacteristicsTable extends ModalComponent
{
    public $currentProductId;
    public $currentCharacteristicId;
    public $characteristicsList;

    public function mount()
    {
        $this->currentProductId = session('currentProductId', null);
        if (empty($this->currentProductId)) {
            $this->closeModal();
            $this->dispatch("sweet-alert", icon: "error", title: __('El producto no existe'));
        }
        $this->characteristicsList = Characteristic::all();
        if (!$this->characteristicsList->isEmpty()) {
            $this->currentCharacteristicId = $this->characteristicsList->first()->id;
        }
    }

    public function render()
    {
        return view('livewire.tables.products-has-characteristics-table');
    }
    public function addCharacteristicToProduct()
    {
        $product = Product::find($this->currentProductId);
        if ($product) {
            $isLinked = $product->characteristics()->where('characteristics.id', $this->currentCharacteristicId)->exists();
            if ($isLinked) {
                $this->dispatch('sweet-alert', icon: 'info', title: __('La característica ya se agregó'));
            } else {
                $product->characteristics()->attach($this->currentCharacteristicId);
                $this->dispatch("reload-table-ProductsHasCharacteristicsTable");
            }
        } else {
            $this->dispatch("sweet-alert", icon: "error", title: __('El producto no existe o está desactivado'));
        }
    }
}
