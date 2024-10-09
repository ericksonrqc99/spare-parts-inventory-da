<div>
    <div class="flex justify-end">
        <button class='px-4 py-1 font-bold hover:bg-indigo-300 transition-all bg-red-300 rounded-bl-md'
            wire:click="$dispatch('closeModal')">X</button>
    </div>
    <div class="p-3">
        <div class="px-3">
            <select class="rounded-md  border-gray-300 shadow-sm" wire:model='currentCategoryId'
                {{$categoriesList->isEmpty()?'disabled':''}}>
                @forelse ($categoriesList as $category)
                <option value={{$category->id}}>{{$category->name}}</option>
                @empty
                <option>No existen categorias crea una</option>
                @endforelse
            </select>
            <button wire:click='addCategoryToProduct' class="p-2 bg-indigo-300 rounded-md border-gray-300 border">Añadir
                Categoría</button>
        </div>
        <livewire:categories-has-products-table />
    </div>
</div>