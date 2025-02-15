<div>
    <div class="flex justify-end">
        <button class='px-4 py-1 font-bold hover:bg-indigo-300 transition-all bg-red-300 rounded-bl-md'
            wire:click="$dispatch('closeModal')">X</button>
    </div>
    <div class="p-3">
        <div class="px-3">
            <select class="rounded-md  border-gray-300 shadow-sm" wire:model='currentCharacteristicId'
                {{$characteristicsList->isEmpty()?'disabled':''}}>
                @forelse ($characteristicsList as $characteristic)
                <option value={{$characteristic->id}}>{{$characteristic->name}}</option>
                @empty
                <option>No existen características crea una</option>
                @endforelse
            </select>
            <button wire:click='addCharacteristicToProduct'
                class="p-2 bg-indigo-300 rounded-md border-gray-300 border">Añadir
                Categoría</button>
        </div>
        <livewire:products-has-characteristics-table />
    </div>
</div>