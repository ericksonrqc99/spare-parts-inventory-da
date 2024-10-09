<?php

namespace App\Livewire\Tables;

use App\Models\Category;
use App\Models\Product;
use LivewireUI\Modal\ModalComponent;

class CategoriesHasProductsTable extends ModalComponent
{
    public $currentProductId;
    public $currentCategoryId;
    public $categoriesList;

    public function mount()
    {
        $this->currentProductId = session("currentProductId", null);
        if (empty($this->currentProductId)) {
            dump($this->currentProductId);
            $this->closeModal();
            $this->dispatch("sweet-alert", icon: "error", title: __('El producto no existe'));
        }
        $this->categoriesList = Category::all();
        if (!$this->categoriesList->isEmpty()) {
            $this->currentCategoryId = $this->categoriesList->first()->id;
        }
    }

    public function addCategoryToProduct(): void
    {
        try {
            $product = Product::find($this->currentProductId);
            if ($product) {
                $isLinked = $product->categories()->where('categories.id', $this->currentCategoryId)->exists();
                if (!$isLinked) {
                    $product->categories()->attach($this->currentCategoryId);
                    $this->dispatch("reload-table-CategoriesHasProductsTable");
                } else {
                    $this->dispatch("sweet-alert", icon: "info", title: __('Categoría ya vinculada'));
                }
            } else {
                $this->dispatch("sweet-alert", icon: "error", title: __('El producto no existe o está desactivado'));
            }
        } catch (\Throwable $th) {
            $this->dispatch('sweet-alert', icon: 'error', title: __('Error'), text: $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.tables.categories-has-products-table');
    }
}
