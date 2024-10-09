<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ValidationModelCarForm extends Form
{
    #[Validate("required|max:100")]
    public $name;
    #[Validate("required|in:1,0")]
    public $status = 1;
    #[Validate("required")]
    public $brands_id;
    #[Validate("required|integer|date_format:Y|before_or_equal:today")]
    public $year;
}
