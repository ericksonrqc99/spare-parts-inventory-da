@props(['disabled' => false])
<form wire:submit='submit' {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(["class"=>"flex flex-col h-fit p-4
    items-center gap-y-4
    border-gray-300
    dark:border-gray-700
    dark:bg-gray-900 dark:text-gray-300
    focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md
    shadow-sm"]) !!}>
    <h2 class="font-bold">{{__("Crear categoria")}}</h2>
    <div class="flex flex-col gap-y-2 w-full">
        <div>
            <input type='radio' id='on' wire:model='status' value='1' name='status' checked>
            <label for='on'>{{__('Activo')}}</label>
            <input type='radio' id='off' wire:model='status' value='0' name='status'>
            <label for='off'> {{__('Inactivo')}}</label>
        </div>
        <x-text-input class="w-full" placeholder="{{__('Nombre')}}" wire:model='name'></x-text-input>
        @if($errors->has('name'))
        <div class="text-red-500 text-sm">{{ $errors->first('name') }}</div>
        @endif
        <x-text-area class="w-full" placeholder="{{__('Descripción')}}" wire:model='description'></x-text-area>
        @if($errors->has('description'))
        <div class="text-red-500 text-sm">{{ $errors->first('description') }}</div>
        @endif
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