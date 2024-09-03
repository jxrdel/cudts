<?php

namespace App\Http\Livewire;

use App\Models\DailyRegister;
use App\Models\Facility;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class DailyRegisterTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public string $primaryKey = 'DailyRegisterID';
    public string $sortField = 'DailyRegisterID';
    public string $sortDirection = 'desc';

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {

        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\DailyRegister>
     */
    public function datasource(): Builder
    {
        return DailyRegister::query()->join('facility', 'dailyregister.FacilityID', '=', 'facility.FacilityID')
            ->select('dailyregister.DailyRegisterID', 'dailyregister.Date as Date', 'dailyregister.FacilityID', 'facility.FacilityName as FacilityName');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('DailyRegisterID')
            ->addColumn('Date_formatted', fn (DailyRegister $model) => Carbon::parse($model->Date)->format('d/m/Y'))
            ->addColumn('FacilityName');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('Daily RegisterID', 'DailyRegisterID')
                ->sortable()
                ->searchable(),
            Column::make('Date', 'Date_formatted', 'Date')
                ->sortable(),

            Column::make('Facility', 'FacilityName')
                ->sortable()
                ->searchable(),

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::inputText('DailyRegisterID')->operators(['contains']),
            // Filter::inputText('FacilityName')->operators(['contains']),
            Filter::select('FacilityName', 'FacilityName')
                ->dataSource(Facility::all())
                ->optionValue('FacilityName')
                ->optionLabel('FacilityName'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid DailyRegister Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'Select')
                ->target('')
                ->class('btn btn-primary cursor-pointer text-white px-3 rounded text-sm')
                ->route('viewpatientvisits', ['id' => 'DailyRegisterID'])

            //    Button::make('destroy', 'Delete')
            //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            //        ->route('daily-register.destroy', function(\App\Models\DailyRegister $model) {
            //             return $model->id;
            //        })
            //        ->method('delete')
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid DailyRegister Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($daily-register) => $daily-register->id === 1)
                ->hide(),
        ];
    }
    */
}
