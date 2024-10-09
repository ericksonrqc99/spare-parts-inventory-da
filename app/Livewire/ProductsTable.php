<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class ProductsTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Product::query()->orderByDesc('id');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('sku')
            ->add('description')
            ->add('price')
            ->add('cost')
            ->add('minimum_stock')
            ->add('stock')
            ->add('alert_stock')
            ->add('generic_use')
            ->add('brands_id', fn($product) => $product->brand->name)
            ->add('suppliers_id', fn($product) => $product->supplier->name)
            ->add('measurement_units_id', function ($product) {
                return $product->measurementUnit->name;
            })
            ->add('status')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            // Column::make('Id', 'id'),
            Column::make('Sku', 'sku')
                ->sortable()
                ->searchable(),
            Column::make(__('Nombre'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('Marca'), 'brands_id')
                ->sortable()
                ->searchable(),
            Column::make(__('Precio'), 'price')
                ->sortable()
                ->searchable(),
            Column::make('Stock', 'stock')
                ->sortable()
                ->searchable(),
            Column::make(__('Unidad de medida'), 'measurement_units_id')
                ->sortable()
                ->searchable(),
            Column::make('Alert stock', 'alert_stock')
                ->sortable()
                ->searchable(),
            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[On('reload-table-ProductsTable')]
    public function reloadTable()
    {
        $this->fillData();
    }

    public function actions(Product $row): array
    {
        return [
            Button::add('edit')
                ->slot('Editar')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('openModal', ["component" => 'forms.product-form', 'arguments' => ["currentProductId" => $row->id]]),
            Button::add('delete')
                ->slot(__('Eliminar'))
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('openModal', ["component" => 'forms.product-form', 'arguments' => ["currentProductId" => $row->id]])
        ];
    }
}
