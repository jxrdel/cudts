<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class PatientTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public $dailyregisterid;

    public string $primaryKey = 'PatCliNumber';
    public string $sortField = 'PatCliNumber';

    // public function mount(): void{

    // }

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

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
     * @return Builder<\App\Models\Patient>
     */
    public function datasource(): Builder
    {
        return Patient::query()
            ->join('facility', 'patient.ClinicNo', '=', 'facility.FacilityID')
            ->select('patient.PatCliNumber as PatCliNumber', 'patient.ClinicNo as ClinicNo', 'patient.RegistrationNumber as RegistrationNumber', 'patient.FirstName as FirstName', 'patient.LastName as LastName', 'facility.FacilityName as FacilityName');
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
        return [
            'patient' => [ // relationship on dishes model
                'ClinicNo', // column enabled to search
                'facility' => ['FacilityID'] // nested relation and column enabled to search
            ],
        ];
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
            ->addColumn('RegistrationNumber')
            ->addColumn('FirstName')
            ->addColumn('LastName')
            ->addColumn('ClinicNo')
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
            Column::make('Registration Number', 'RegistrationNumber')
                ->sortable()
                ->searchable(),

            Column::make('First Name', 'FirstName')
                ->sortable()
                ->searchable(),

            Column::make('Last Name', 'LastName')
                ->sortable()
                ->searchable(),

            Column::make('Clinic #', 'ClinicNo')
                ->searchable(),

            Column::make('Facility Name', 'FacilityName')
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
            Filter::inputText('RegistrationNumber')->operators(['contains']),
            Filter::inputText('FirstName')->operators(['contains']),
            Filter::inputText('LastName')->operators(['contains']),
            Filter::inputText('ClinicNo')->operators(['contains']),
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
     * PowerGrid Patient Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'Select')
                ->target('')
                ->class('btn btn-primary cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('newpatientvisit', ['id' => 'PatCliNumber', 'drid' => $this->dailyregisterid]),

            //    Button::make('destroy', 'Delete')
            //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            //        ->route('patient.destroy', function(\App\Models\Patient $model) {
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
     * PowerGrid Patient Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($patient) => $patient->id === 1)
                ->hide(),
        ];
    }
    */
}
