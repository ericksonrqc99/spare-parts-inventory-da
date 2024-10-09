<?php

namespace App\Livewire;

use App\Models\ModelCar;
use App\Models\Product;
use App\Models\ProductsHasModelCars;
use Illuminate\Support\Carbon;
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

final class ProductsHasModelCarsTable extends PowerGridComponent
{
    use WithExport;
    public $currentProductId;
    public function setUp(): array
    {
        $this->currentProductId = session("currentProductId", null);
        return [
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        if ($this->currentProductId) {
            return ModelCar::query()
                ->join('products_has_model_cars', 'model_cars.id', '=', 'products_has_model_cars.model_cars_id')
                ->where('products_has_model_cars.products_id', $this->currentProductId)
                ->select('model_cars.*');
        }

        // Si no hay currentProductId, retorna una consulta vacía sin ejecutar ninguna consulta
        return ModelCar::query()->select('model_cars.*')->whereRaw('1 = 0'); // Esto retorna un Builder sin resultados
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('name');
    }

    public function columns(): array
    {
        return [
            Column::make(__('Modelo'), 'name'),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[On('delete-row-ProductsHasModelCarsTable')]
    public function deleteRow($rowId): void
    {
        $product = Product::find($this->currentProductId);
        $product->modelCars()->detach($rowId);
        $this->reloadTable();
    }

    #[On('reload-table-ProductsHasModelCarsTable')]
    public function reloadTable()
    {
        $this->fillData();
    }


    public function actions(ModelCar $row): array
    {
        return [
            Button::add('delete')
                ->slot(__('Eliminar'))
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('delete-row-ProductsHasModelCarsTable', ['rowId' => $row->id])
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
