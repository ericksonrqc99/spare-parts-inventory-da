<?php

namespace App\Livewire\Forms;

use App\Models\Brand;
use Livewire\Features\SupportTesting\DuskBrowserMacros;
use LivewireUI\Modal\ModalComponent;

class BrandForm extends ModalComponent
{
    public ValidationBrandForm $brand;

    public function render()
    {
        return view('livewire.forms.brand-form');
    }


    public function submit()
    {
        $this->validate();
        $this->store();
        $this->closeModal();
        $this->dispatch("sweet-alert", icon: "success", title: "Marca creada");
        $this->dispatch("created-brand");
    }

    public function store()
    {
        Brand::create($this->cleanData($this->brand->all()));
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
    public static function closeModalOnEscapeIsForceful(): bool
    {
        return false;
    }
}
