<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ValidationSupplierForm extends Form
{
    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|string|max:100')]
    public $contact;

    #[Validate('nullable|string|max:100')]
    public $country;

    #[Validate('nullable|string|max:100')]
    public $state;

    #[Validate('nullable|string|max:100')]
    public $city;

    #[Validate('nullable|string|max:255')]
    public $address;

    #[Validate('required|string|max:20')]
    public $phone;

    #[Validate('nullable|email|string|max:255')]
    public $email;
}
