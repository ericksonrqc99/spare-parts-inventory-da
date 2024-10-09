<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Validate;

class CategoryForm extends ModalComponent
{
    #[Validate("required")]
    public $name;
    #[Validate("nullable|min:10")]
    public $description;
    #[Validate('required|in:1,0')]
    public $status = 1;

    public function render()
    {
        return view('livewire.forms.category-form');
    }

    public function submit()
    {
        $this->validate();
        // TODO:add policies only admins create categories
        $this->store();
        $this->closeModal();
        $this->dispatch("sweet-alert", icon: "success", title: "Categoría creada");
    }

    public function store()
    {
        Category::create([
            "name" => $this->name,
            "description" => $this->description,
            "status" => $this->status
        ]);
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
