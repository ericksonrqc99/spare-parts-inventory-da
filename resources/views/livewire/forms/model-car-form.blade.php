@props(['disabled' => false])
<div class="flex flex-col">
    <div class="flex justify-end">
        <button class='px-3 py-1 font-bold hover:bg-indigo-300 transition-all bg-indigo-500 rounded-bl-md'
            wire:click="$dispatch('closeModal')">X</button>
    </div>
    <form wire:submit='submit' {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(["class"=>"flex flex-col h-fit
        px-4 pb-4
        items-center gap-y-4
        border-gray-300
        dark:border-gray-700
        dark:bg-gray-900 dark:text-gray-300
        focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md
        shadow-sm"]) !!}>
        <h2 class="font-bold">{{__("Crear modelo de vehículo")}}</h2>
        <div class="flex flex-col gap-y-2 w-full">
            <div>
                <input type='radio' id='on' wire:model='status' value='1' name='status' checked>
                <label for='on'>{{__('Activo')}}</label>
                <input type='radio' id='off' wire:model='status' value='0' name='status'>
                <label for='off'> {{__('Inactivo')}}</label>
            </div>
            <x-text-input class="w-full" placeholder="{{__('Nombre')}}" wire:model='modelCar.name'>
            </x-text-input>
            @if($errors->has('modelCar.name'))
            <div class="text-red-500 text-sm">{{ $errors->first('modelCar.name') }}</div>
            @endif

            <x-text-input class="w-full" placeholder="{{__('Año')}}" wire:model='modelCar.year'>
            </x-text-input>
            @if($errors->has('modelCar.year'))
            <div class="text-red-500 text-sm">{{ $errors->first('modelCar.year') }}</div>
            @endif
            <div class="flex flex-col w-full">
                <label for="brands" class="text-sm text-gray-500">{{__("Selecciona una marca")}}</label>
                <select class="border-gray-300 dark:border-gray-700
                    dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500
                    dark:focus:ring-indigo-600 rounded-md shadow-sm" id="brands" wire:model='modelCar.brands_id'>
                    @forelse ($brands as $brand )
                    <option value="{{$brand->id}}">{{__($brand->name)}}</option>
                    @empty
                    <option>{{__("No existen marcas crea una")}}</option>
                    @endforelse
                </select>
                @if($errors->has('modelCar.brands_id'))
                <div class="text-red-500 text-sm">{{ $errors->first('modelCar.brands_id') }}</div>
                @endif
            </div>
        </div>
        <button type="submit" {!! $attributes->merge(["class"=>"flex flex-col p-2 items-center gap-y-2
            border-gray-300
            w-1/2
            dark:border-gray-700
            dark:bg-gray-900 dark:text-gray-300
            bg-indigo-200
            font-bold
            border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md
            shadow-sm"]) !!}>Crear</button>
    </form>
</div>