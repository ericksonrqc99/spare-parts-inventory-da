<?php

namespace App\Livewire;

use App\Models\Brand;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
use Livewire\Attributes\On;

final class BrandsTable extends PowerGridComponent
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

    public function change() {}
    public function datasource(): Builder
    {
        return Brand::query();
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
            ->add('status', function ($brand) {
                switch ($brand->status) {
                    case 1:
                        return e(__("Activo"));
                        break;
                    case 0:
                        return e(__("Inactivo"));
                        break;
                    default:
                        return e("-------");
                        break;
                }
            })
        ;
    }
    
    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make(__('Nombre'), 'name')
                ->sortable()
                ->searchable(),

            Column::make(__('Estado'), 'status')
                ->sortable()
                ->searchable(),

            Column::action(__('Acciones'))
        ];
    }

    public function filters(): array
    {
        return [Filter::boolean('Status', 'Status')->label('Active', 'Inactive')];
    }

    #[On('edit-brand')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    #[On('created-brand')]
    public function reRenderTable()
    {
        $this->fillData();
    }

    public function actions(Brand $row): array
    {
        return [
            Button::add('edit')
                ->slot(__('Editar: ') . $row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit-brand', ['rowId' => $row->id])
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
