<?php

namespace App\Livewire\Forms;

use App\Models\MeasurementUnit;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ValidationMeasurementUnitForm extends Form
{
    #[Validate("required|max:45")]
    public $name;

    #[Validate('required|max:10')]
    public $abbreviation;
}
