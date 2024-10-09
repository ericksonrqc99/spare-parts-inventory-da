<?php

namespace App\Livewire\Forms;

use App\Models\Characteristic;
use LivewireUI\Modal\ModalComponent;

class CharacteristicForm extends ModalComponent
{
    public ValidationCharacteristicForm $characteristic;

    public function render()
    {
        return view('livewire.forms.characteristic-form');
    }

    public function submit()
    {
        $this->validate();
        $this->store();
        $this->closeModal();
        $this->dispatch("sweet-alert", icon: "success", title: "Carácterística creada");
    }

    public function store()
    {
        Characteristic::create($this->cleanData($this->characteristic->all()));
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
