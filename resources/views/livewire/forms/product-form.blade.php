@props(['disabled' => false])
<div class="w-full border-gray-300
        dark:border-gray-700
        dark:bg-gray-900 dark:text-gray-300
        focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md
        shadow-sm">
    <div class="flex justify-end">
        <button class='px-4 py-1 font-bold hover:bg-indigo-300 transition-all bg-red-300 rounded-bl-md'
            wire:click="$dispatch('closeModal')">X</button>
    </div>
    <form wire:submit='submit' {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(["class"=>"flex flex-col h-fit
        px-6 pb-4
        w-full
        items-center gap-y-4"]) !!}>
        <h2 class="font-bold text-xl">{{$currentProductId?__('Actualizar Producto'):__('Crear Producto')}}</h2>
        <!-- SKU -->
        <div class="w-full">
            <label for="product.sku" class='text-sm text-gray-500'>{{__('Código interno - SKU')}}</label>
            <x-text-input type="text" class="w-full m-0" id='product.sku'
                placeholder="{{__('Introduce el código SKU')}}" wire:model='product.sku'>
            </x-text-input>
        </div>
        <div class="flex flex-col md:flex-row gap-2 w-full">
            {{-- col 1 --}}
            <div class="w-full flex flex-col gap-y-2">
                <!-- Nombre -->
                <div>
                    <label for="product.name" class='text-sm text-gray-500'>{{__('Nombre')}}</label>
                    <x-text-input type="text" class="w-full m-0" id='product.name'
                        placeholder="{{__('Introduce el nombre del producto')}}" wire:model='product.name'>
                    </x-text-input>
                </div>
                <!-- Marca -->
                <div class="w-full">
                    <label for="select_brand" class='text-sm text-gray-500'>{{__("Seleccione una marca")}}</label>
                    <select id="select_brand"
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        wire:model='product.brands_id'>
                        @forelse ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @empty
                        <option>{{__('No existen marcas, crea una')}}</option>
                        @endforelse
                    </select>
                </div>

                <!-- Proveedor -->
                <div class="w-full">
                    <label for="select_supplier" class="text-sm text-gray-500 dark:text-white">{{__("Seleccione un
                        proveedor")}}</label>
                    <select id="select_supplier"
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        wire:model='product.suppliers_id'>
                        @forelse ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @empty
                        <option>{{__('No existen proveedores, crea uno')}}</option>
                        @endforelse
                    </select>
                </div>


                <!-- Unidad de Medida -->
                <div class="w-full">
                    <label for="select_measurement_unit" class='text-sm text-gray-500'>{{__("Seleccione una unidad
                        de
                        medida")}}</label>
                    <select id="select_measurement_unit"
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        wire:model='product.measurement_units_id'>
                        @forelse ($measurementUnits as $measurementUnit)
                        <option value="{{ $measurementUnit->id }}">{{ $measurementUnit->name }}</option>
                        @empty
                        <option>{{__('No existen unidades de medida, crea una')}}</option>
                        @endforelse
                    </select>
                </div>

                <!-- Locación -->
                <div>
                    <label for="location" class='text-sm text-gray-500'>{{__('Locación')}}</label>
                    <x-text-input class="w-full m-0" id="location"
                        placeholder="{{__('Introduce la locación del producto')}}" wire:model='location'>
                    </x-text-input>
                </div>

                <!-- Costo de Adquisición -->
                <div>
                    <label for="product.cost" class='text-sm text-gray-500'>{{__('Costo de adquisición')}}</label>
                    <x-text-input type="number" class="w-full m-0" id="product.cost" placeholder="{{__('0.00')}}"
                        wire:model='product.cost' step="0.01">
                    </x-text-input>
                </div>
                <!-- Precio de Venta -->
                <div>
                    <label for="product.price" class='text-sm text-gray-500'>{{__('Precio de venta')}}</label>
                    <x-text-input type="number" class="w-full m-0" id="product.price" placeholder="{{__('0.00')}}"
                        wire:model='product.price' step="0.01">
                    </x-text-input>
                </div>

            </div>

            {{-- col 2 --}}
            <div class="w-full flex flex-col gap-y-2 ">
                <!-- Stock Inicial -->
                <div>
                    <label for="product.stock" class='text-sm text-gray-500'>{{__('Stock inicial')}}</label>
                    <x-text-input type="number" class="w-full m-0" id="product.stock" placeholder="{{__('0')}}"
                        wire:model='product.stock'>
                    </x-text-input>
                </div>
                <!-- Alerta de Stock Mínimo -->
                <div>
                    <label class="text-sm text-gray-500" for='alert_stock'>{{__('Alerta de stock mínimo')}}</label>
                    <div class='border rounded-md p-2 w-full flex gap-x-2 items-center' id='alert_stock'>
                        <x-text-input value='1' type="radio" id="on_alert_stock" name='radio_alert_stock'
                            wire:model='product.alert_stock'></x-text-input>
                        <label for="on_alert_stock">Si</label>
                        <x-text-input value='0' type="radio" id='off_alert_stock' name='radio_alert_stock'
                            wire:model='product.alert_stock'></x-text-input>
                        <label for="off_alert_stock">No</label>
                    </div>
                </div>

                <!-- Stock Mínimo -->
                {{-- TODO: Disabled stock mínimo input with alert stock in 'no' --}}
                <div>
                    <label for="product.minimum_stock" class='text-sm text-gray-500'>{{__('Stock mínimo')}}</label>
                    <x-text-input type="number" class="w-full m-0" id="product.minimum_stock" placeholder="{{__('0')}}"
                        wire:model='product.minimum_stock'>
                    </x-text-input>
                </div>
                {{-- Button categories --}}
                <div>
                    <label for="product.minimum_stock" class='text-sm text-gray-500'>{{__('Seleccione las
                        categorías')}}</label>

                    <button type='button' class="block w-full border-gray-300 p-2 border
                 dark:border-gray-700
                 dark:bg-gray-900 dark:text-gray-300
                 font-bold
                 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md
                shadow-sm text-md {{!$currentProductId?'cursor-not-allowed bg-slate-200':'bg-indigo-400'}} "
                        onclick="Livewire.dispatch('openModal', { component: 'tables.categories-has-products-table'})"
                        {{!$currentProductId?'disabled':''}}>
                        {{__('Categorías del producto')}}
                    </button>

                </div>

                {{-- Button characteristics --}}
                <div>
                    <label for="product.minimum_stock" class='text-sm text-gray-500'>{{__('Seleccione las
                        carácterísticas')}}</label>
                    <button type="button" class="block w-full border-gray-300 p-2
                    border
                dark:border-gray-700
                dark:bg-gray-900 dark:text-gray-300
               
                font-bold
                 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md
                shadow-sm text-md  {{!$currentProductId?'cursor-not-allowed bg-slate-200':'bg-indigo-400'}}"
                        onclick="Livewire.dispatch('openModal', { component: 'tables.products-has-characteristics-table'})"
                        {{!$currentProductId?'disabled':''}}>{{__('Características
                        del producto')}}</button>
                </div>

                {{-- Button models car --}}
                <div>
                    <label for="product.minimum_stock" class='text-sm text-gray-500'>{{__("Seleccione los vehículos
                        compatibles")}}</label>
                    <button type="button" class="block w-full border-gray-300 p-2 border
                dark:border-gray-700
                dark:bg-gray-900 dark:text-gray-300
               
                font-bold
                 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md
                shadow-sm text-md  {{!$currentProductId?'cursor-not-allowed bg-slate-200':'bg-indigo-400'}}"
                        onclick="Livewire.dispatch('openModal', { component: 'tables.products-has-model-cars-table'})"
                        {{!$currentProductId?'disabled':''}}>{{__('Vehículos
                        compatibles')}}</button>
                </div>
            </div>

        </div>
        <div class="w-full">
            <!-- Descripción -->
            <label for="description" class='text-sm text-gray-500'>{{__('Descripción')}}</label>
            <x-text-area class="w-full" id="description" placeholder="{{__('Introduce una descripción del producto')}}"
                wire:model='description'>
            </x-text-area>

        </div>

        @if ($errors->any())
        <div class="text-red-500 text-sm">{{ $errors->first() }}</div>
        @endif
        <button type="submit" {!! $attributes->merge(["class"=>"flex flex-col p-2 items-center gap-y-2
            border-gray-300
            w-1/2
            dark:border-gray-700
            dark:bg-gray-900 dark:text-gray-300
            bg-indigo-500
            font-bold
            border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md
            shadow-sm text-xl"]) !!}>Guardar</button>
    </form>
</div>