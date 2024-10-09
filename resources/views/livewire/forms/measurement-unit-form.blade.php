@props(['disabled' => false])
<div class="flex flex-col">
    <div class="flex justify-end">
        <button class='px-3 py-1 font-extrabold hover:bg-indigo-300 transition-all bg-red-300 rounded-bl-md'
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
        <h2 class="font-bold text-xl">{{__("Crear unidad de medida")}}</h2>
        <div class="flex flex-col gap-y-2 w-full">
            <div>
                <label class="text-sm text-gray-500" for="measurementUnit.name">
                    {{__('Nombre')}}
                </label>
                <x-text-input id='measurementUnit.name' class="w-full"
                    placeholder="{{__('Introduce el nombre de la unidad')}}" wire:model='measurementUnit.name'>
                </x-text-input>
                @if($errors->has('measurementUnit.name'))
                <div class="text-red-500 text-sm">{{ $errors->first('measurementUnit.name') }}</div>
                @endif
            </div>
            <div>
                <label class='text-sm text-gray-500' for="measurementUnit.abbreviation">{{__('Abreviación')}}</label>
                <x-text-input id='measurementUnit.abbreviation' class="w-full"
                    placeholder="{{__('Ingrese la abreviación de la unidad')}}"
                    wire:model='measurementUnit.abbreviation'>
                </x-text-input>
                @if($errors->has('measurementUnit.abbreviation'))
                <div class="text-red-500 text-sm">{{ $errors->first('measurementUnit.abbreviation') }}</div>
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
            text-xl
            border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md
            shadow-sm"]) !!}>Crear</button>
    </form>
</div>