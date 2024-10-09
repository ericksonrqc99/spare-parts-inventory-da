<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>


    <x-button-create-product></x-button-create-product>
    <x-button-create-category></x-button-create-category>
    <x-button-create-supplier></x-button-create-supplier>
    <x-button-create-brand></x-button-create-brand>
    <x-button-create-measurement-unit></x-button-create-measurement-unit>
    <x-button-create-model-car></x-button-create-model-car>
    <x-button-create-characteristic></x-button-create-characteristic>
    {{-- <div class="px-40 ">
        <livewire:brands-table></livewire:brands-table>
    </div> --}}
    <div class="w-5/6 m-auto">
        <livewire:products-table />
    </div>
    <div class=" py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Productos") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>