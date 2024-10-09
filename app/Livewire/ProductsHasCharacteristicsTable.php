<?php

namespace App\Livewire;

use App\Models\Characteristic;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class ProductsHasCharacteristicsTable extends PowerGridComponent
{
    use WithExport;
    public $currentProductId;
    public $product;
    
    public function setUp(): array
    {
        $this->currentProductId = session("currentProductId");
        $this->product = Product::find($this->currentProductId);

        return [
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        // Verifica si el currentProductId es válido
        if ($this->currentProductId) {
            // return Characteristic::query()
            //     ->join('categories_has_products', 'categories.id', '=', 'categories_has_products.categories_id')
            //     ->where('categories_has_products.products_id', $this->currentProductId)
            //     ->select('categories.*');

            return Characteristic::query()
                ->join('products_has_characteristics', 'characteristics.id', '=', 'products_has_characteristics.characteristics_id')
                ->where('products_has_characteristics.products_id', $this->currentProductId)
                ->select('characteristics.*', 'products_has_characteristics.value');
        }


        // Si no hay currentProductId, retorna una consulta vacía sin ejecutar ninguna consulta
        return Characteristic::query()->select('characteristics.*')->whereRaw('1 = 0'); // Esto retorna un Builder sin resultados
    }

    public function relationSearch(): array
    {
        return [];
    }


    public function onUpdatedEditable(string|int $id, string $field, string $value): void
    {
        $product = Product::find($this->currentProductId);
        $product->characteristics()->updateExistingPivot($id, ['value' => $value]);
    }
    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()->add('name')->add('value');
    }

    public function columns(): array
    {
        return [
            Column::make(__("Carácteristicas"), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__("Valor"), 'value')
                ->sortable()
                ->editOnClick()
                ->searchable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[On('delete-row-ProductsHasCharacteristicsTable')]
    public function delete($rowId): void
    {
        $this->product->characteristics()->detach($rowId);
        $this->reloadTable();
    }

    #[On('reload-table-ProductsHasCharacteristicsTable')]
    public function reloadTable()
    {
        $this->fillData();
    }

    public function actions(Characteristic $row): array
    {
        return [
            Button::add('delete')
                ->slot('Eliminar')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('delete-row-ProductsHasCharacteristicsTable', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
