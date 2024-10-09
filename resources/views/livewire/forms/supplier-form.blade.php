@props(['disabled' => false])
<form wire:submit='submit' {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(["class"=>"flex flex-col h-fit p-8
    items-center gap-y-4
    border-gray-300
    dark:border-gray-700
    dark:bg-gray-900 dark:text-gray-300
    focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md
    shadow-sm"]) !!}>
    <h2 class="font-bold">{{__("Crear proveedor")}}</h2>
    <div class="flex flex-col gap-y-2 w-full">
        <x-text-input type="text" class="w-full" placeholder="{{__('Nombre de empresa')}}" wire:model='supplier.name'>
        </x-text-input>
        @if($errors->has('supplier.name'))
        <div class="text-red-500 text-sm">{{ $errors->first('supplier.name') }}</div>
        @endif

        <x-text-input type="text" class="w-full" placeholder="{{__('Nombre del contacto')}}"
            wire:model='supplier.contact'>
        </x-text-input>
        @if($errors->has('supplier.contact'))
        <div class="text-red-500 text-sm">{{ $errors->first('supplier.contact') }}</div>
        @endif

        <x-text-input class="w-full" placeholder="{{__('Teléfono del contacto')}}" wire:model='supplier.phone'>
        </x-text-input>
        @if($errors->has('supplier.phone'))
        <div class="text-red-500 text-sm">{{ $errors->first('supplier.phone') }}</div>
        @endif


        <div class="w-full leading-none">
            <label for="" class="text-sm text-gray-500">{{__("Selecciona un país")}}</label>
            <x-select-location class="w-full" :array=$countries model='supplier.country'></x-select-location>
            @if($errors->has('supplier.country'))
            <div class="text-red-500 text-sm">{{ $errors->first('supplier.country') }}</div>
            @endif
        </div>
        <div class="w-full leading-none">
            <label for="" class="text-sm text-gray-500">{{__("Selecciona un región")}}</label>
            <x-select-location class="w-full" :array=$states model='supplier.state'></x-select-location>
            @if($errors->has('supplier.state'))
            <div class="text-red-500 text-sm">{{ $errors->first('supplier.state') }}</div>
            @endif
        </div>
        <div class="w-full leading-none">
            <label for="" class="text-sm text-gray-500">{{__("Selecciona un ciudad")}}</label>
            <x-select-location class="w-full" :array=$cities model='supplier.city'></x-select-location>
            @if($errors->has('supplier.city'))
            <div class="text-red-500 text-sm">{{ $errors->first('supplier.city') }}</div>
            @endif
        </div>



        <x-text-input class="w-full" placeholder="{{__('Dirección')}}" wire:model='supplier.address'></x-text-input>
        @if($errors->has('supplier.address'))
        <div class="text-red-500 text-sm">{{ $errors->first('supplier.address') }}</div>
        @endif




        <x-text-input class="w-full" placeholder="{{__('Correo')}}" wire:model='supplier.email'></x-text-input>
        @if($errors->has('supplier.email'))
        <div class="text-red-500 text-sm">{{ $errors->first('supplier.email') }}</div>
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