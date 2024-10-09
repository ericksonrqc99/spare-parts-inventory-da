<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class CategoriesHasProductsTable extends PowerGridComponent
{
    use WithExport;

    public $currentProductId;

    public function setUp(): array
    {
        $this->currentProductId = session("currentProductId");

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
            return Category::query()
                ->join('categories_has_products', 'categories.id', '=', 'categories_has_products.categories_id')
                ->where('categories_has_products.products_id', $this->currentProductId)
                ->select('categories.*');
        }

        // Si no hay currentProductId, retorna una consulta vacía sin ejecutar ninguna consulta
        return Category::query()->select('categories.*')->whereRaw('1 = 0'); // Esto retorna un Builder sin resultados
    }


    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()->add('name');
    }

    public function columns(): array
    {
        return [
            Column::make(__("Categorias"), 'name')
                ->sortable()
                ->searchable(),
            Column::action('Acciones'),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('delete-row-CategoriesHasProductsTable')]
    public function deleteRow($rowId): void
    {
        $category = Category::find($rowId);
        $category->products()->detach($this->currentProductId);
        $this->reloadTable();
    }

    #[\Livewire\Attributes\On('reload-table-CategoriesHasProductsTable')]
    public function reloadTable()
    {
        $this->fillData();
    }

    public function actions(Category $row): array
    {
        return [
            Button::add('delete')
                ->slot(__('Eliminar'))
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('delete-row-CategoriesHasProductsTable', ['rowId' => $row->id])
        ];
    }
}
