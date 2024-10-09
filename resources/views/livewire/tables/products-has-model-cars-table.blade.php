<div>
    <div class="flex justify-end">
        <button class='px-4 py-1 font-bold hover:bg-indigo-300 transition-all bg-red-300 rounded-bl-md'
            wire:click="$dispatch('closeModal')">X</button>
    </div>
    <div class="p-3">
        <div class="px-3">
            <select class="rounded-md  border-gray-300 shadow-sm" wire:model='currentModelCarId'
                {{$modelCarsList->isEmpty()?'disabled':''}}>
                @forelse ($modelCarsList as $modelCar)
                <option value={{$modelCar->id}}>{{$modelCar->name}}</option>
                @empty
                <option>No existen modelos de vehículos crea uno</option>
                @endforelse
            </select>
            <button wire:click='addModelCarToProduct' class="p-2 bg-indigo-300 rounded-md border-gray-300 border">Añadir
                Modelo</button>
        </div>
        <livewire:products-has-model-cars-table />
    </div>
</div>