<?php

namespace App\Livewire\Forms;

use App\Models\MeasurementUnit;
use LivewireUI\Modal\ModalComponent;

class MeasurementUnitForm extends ModalComponent
{
    public ValidationMeasurementUnitForm $measurementUnit;

    public function render()
    {
        return view('livewire.forms.measurement-unit-form');
    }

    public function submit()
    {
        $this->validate();
        $this->store();
        $this->closeModal();
        $this->dispatch("sweet-alert", icon: "success", title: "Unidad de mediada creada");
    }

    public function store()
    {
        MeasurementUnit::create($this->cleanData($this->measurementUnit->all()));
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
