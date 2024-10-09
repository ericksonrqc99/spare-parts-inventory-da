<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class ConceptForm extends Component
{
    public function render()
    {
        return view('livewire.forms.concept-form');
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
