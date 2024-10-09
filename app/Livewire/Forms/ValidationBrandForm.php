<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ValidationBrandForm extends Form
{
    #[Validate("required|max:100")]
    public $name;

    #[Validate('required|in:1,0')]
    public $status = 1;

    #[Validate("nullable|max:255")]
    public $description;
}
