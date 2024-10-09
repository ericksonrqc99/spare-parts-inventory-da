<?php

namespace App\Livewire\Forms;

use App\Models\Country;
use App\Models\State;
use App\Models\Supplier;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;



class SupplierForm extends ModalComponent
{
    public ValidationSupplierForm $supplier;
    public $countries;
    public $states;
    public $cities;

    public function render()
    {
        return view('livewire.forms.supplier-form');
    }

    public function mount()
    {
        // Traer todos los países ordenados alfabéticamente
        $this->countries = Country::orderBy('name', 'asc')->get();
        $this->supplier->country = $this->countries[0]->name;
        // Verificar que hay al menos un país en la lista
        if ($this->countries->isNotEmpty()) {
            // Obtener el primer país
            $firstCountry = $this->countries[0];
            // Obtener los estados asociados a ese país
            $this->states = $firstCountry->states()->orderBy('name', 'asc')->get();
            $this->supplier->state = $this->states[0]->name;
            if ($this->states->isNotEmpty()) {
                $firstState = $this->states[0];
                $this->cities = $firstState->cities()->orderBy('name', 'asc')->get();
                $this->supplier->city = $this->cities[0]->name;
            } else {
                $this->cities = [];
            }
        } else {
            // No hay países, inicializar $this->states como vacío
            $this->states = [];
        }
    }


    public function updatedSupplierCountry()
    {
        $this->loadStates($this->supplier->country);
    }

    public function loadStates($countryName)
    {
        $selectedCountry = Country::where("name", $countryName)->get();
        $this->states = $selectedCountry->first()->states()->orderBy('name', 'asc')->get();
        if ($this->states->isEmpty()) {
            $this->states = [];
            $this->supplier->state = null;
            $this->cities = [];
            $this->supplier->city = null;
        } else {
            $this->supplier->state = $this->states[0]->name;
            $this->loadCities($this->states[0]->name);
        }
    }

    public function updatedSupplierState()
    {
        $this->loadCities($this->supplier->state);
    }

    public function loadCities($stateName)
    {
        $selectedState = State::where("name", $stateName)->get();
        $this->cities = $selectedState->first()->cities()->orderBy('name', 'asc')->get();
        if ($this->cities->isEmpty()) {
            $this->supplier->city = null;
            $this->cities = [];
        } else {
            $this->supplier->city = $this->cities[0]->name;
        }
    }

    public function submit()
    {
        $this->validate();
        // TODO:add policies only admins create suppliers
        $this->store();
        $this->closeModal();
        $this->dispatch("sweet-alert", icon: "success", title: "Proveedor creado");
    }

    public function store()
    {
        Supplier::create($this->supplier->all());
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
