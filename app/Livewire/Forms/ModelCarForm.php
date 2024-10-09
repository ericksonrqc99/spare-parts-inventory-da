<?php

namespace App\Livewire\Forms;

use App\Models\Brand;
use App\Models\ModelCar;
use LivewireUI\Modal\ModalComponent;

class ModelCarForm extends ModalComponent
{
    public ValidationModelCarForm $modelCar;
    public $brands;
    public function render()
    {
        return view('livewire.forms.model-car-form');
    }

    public function mount()
    {
        $this->brands = Brand::all();
        if ($this->brands->isNotEmpty()) {
            $this->modelCar->brands_id = $this->brands->first()->id;
        }
    }

    public function submit()
    {
        $this->validate();
        $this->store();
        $this->closeModal();
        $this->dispatch("sweet-alert", icon: "success", title: "Modelo de carro creado");
    }

    public function store()
    {
        ModelCar::create($this->cleanData($this->modelCar->all()));
    }

    public function confirmUnique(){
        
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
}
