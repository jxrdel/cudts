<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class CaseCardTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

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
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
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
        return Patient::query();
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
            ->addColumn('PatCliNumber')
            ->addColumn('PatCliNumber')
            ->addColumn('RegistrationNumber')

           /** Example of custom column using a closure **/
            ->addColumn('RegistrationNumber_lower', fn (Patient $model) => strtolower(e($model->RegistrationNumber)))

            ->addColumn('ClinicNo')
            ->addColumn('CaseCardDate_formatted', fn (Patient $model) => Carbon::parse($model->CaseCardDate)->format('d/m/Y H:i:s'))
            ->addColumn('FirstName')
            ->addColumn('LastName')
            ->addColumn('PatientNID')
            ->addColumn('PatientDP')
            ->addColumn('PatientPassportNo')
            ->addColumn('FormerRegistrationNumber')
            ->addColumn('FormerClinicNumber')
            ->addColumn('Gender')
            ->addColumn('Age')
            ->addColumn('StreetName')
            ->addColumn('CityName')
            ->addColumn('Country')
            ->addColumn('ChStreetName')
            ->addColumn('ChCityName')
            ->addColumn('TelephoneContact')
            ->addColumn('DateOfBirth_formatted', fn (Patient $model) => Carbon::parse($model->DateOfBirth)->format('d/m/Y H:i:s'))
            ->addColumn('EthicGroup')
            ->addColumn('Religion')
            ->addColumn('EduAttainment')
            ->addColumn('UniStatus')
            ->addColumn('EmpStatus')
            ->addColumn('HouseHoldIncomeOcc')
            ->addColumn('HouseHoldIncomeRange')
            ->addColumn('ClinicInfluence')
            ->addColumn('NumPregnancies')
            ->addColumn('NumLiveBirths')
            ->addColumn('NumChildAlive')
            ->addColumn('YrLastPregnacy')
            ->addColumn('GestWeeks')
            ->addColumn('OutLastPrenancy')
            ->addColumn('ChildMore')
            ->addColumn('ChildHave')
            ->addColumn('ChildHaveNodata')
            ->addColumn('InfertCase')
            ->addColumn('ContraBefore')
            ->addColumn('NameContra')
            ->addColumn('ContraceptionUsed')
            ->addColumn('ContraceptionType')
            ->addColumn('DateCreated_formatted', fn (Patient $model) => Carbon::parse($model->DateCreated)->format('d/m/Y H:i:s'))
            ->addColumn('CreatedBy')
            ->addColumn('DateModified_formatted', fn (Patient $model) => Carbon::parse($model->DateModified)->format('d/m/Y H:i:s'))
            ->addColumn('ModifiedBy');
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
            Column::make('PatCliNumber', 'PatCliNumber'),
            Column::make('PatCliNumber', 'PatCliNumber'),
            Column::make('RegistrationNumber', 'RegistrationNumber')
                ->sortable()
                ->searchable(),

            Column::make('ClinicNo', 'ClinicNo')
                ->sortable()
                ->searchable(),

            Column::make('CaseCardDate', 'CaseCardDate_formatted', 'CaseCardDate')
                ->sortable(),

            Column::make('FirstName', 'FirstName')
                ->sortable()
                ->searchable(),

            Column::make('LastName', 'LastName')
                ->sortable()
                ->searchable(),

            Column::make('PatientNID', 'PatientNID')
                ->sortable()
                ->searchable(),

            Column::make('PatientDP', 'PatientDP')
                ->sortable()
                ->searchable(),

            Column::make('PatientPassportNo', 'PatientPassportNo')
                ->sortable()
                ->searchable(),

            Column::make('FormerRegistrationNumber', 'FormerRegistrationNumber')
                ->sortable()
                ->searchable(),

            Column::make('FormerClinicNumber', 'FormerClinicNumber')
                ->sortable()
                ->searchable(),

            Column::make('Gender', 'Gender'),
            Column::make('Age', 'Age'),
            Column::make('StreetName', 'StreetName')
                ->sortable()
                ->searchable(),

            Column::make('CityName', 'CityName')
                ->sortable()
                ->searchable(),

            Column::make('Country', 'Country')
                ->sortable()
                ->searchable(),

            Column::make('ChStreetName', 'ChStreetName')
                ->sortable()
                ->searchable(),

            Column::make('ChCityName', 'ChCityName')
                ->sortable()
                ->searchable(),

            Column::make('TelephoneContact', 'TelephoneContact')
                ->sortable()
                ->searchable(),

            Column::make('DateOfBirth', 'DateOfBirth_formatted', 'DateOfBirth')
                ->sortable(),

            Column::make('EthicGroup', 'EthicGroup'),
            Column::make('Religion', 'Religion'),
            Column::make('EduAttainment', 'EduAttainment'),
            Column::make('UniStatus', 'UniStatus'),
            Column::make('EmpStatus', 'EmpStatus'),
            Column::make('HouseHoldIncomeOcc', 'HouseHoldIncomeOcc')
                ->sortable()
                ->searchable(),

            Column::make('HouseHoldIncomeRange', 'HouseHoldIncomeRange'),
            Column::make('ClinicInfluence', 'ClinicInfluence')
                ->sortable()
                ->searchable(),

            Column::make('NumPregnancies', 'NumPregnancies'),
            Column::make('NumLiveBirths', 'NumLiveBirths'),
            Column::make('NumChildAlive', 'NumChildAlive'),
            Column::make('YrLastPregnacy', 'YrLastPregnacy'),
            Column::make('GestWeeks', 'GestWeeks'),
            Column::make('OutLastPrenancy', 'OutLastPrenancy')
                ->sortable()
                ->searchable(),

            Column::make('ChildMore', 'ChildMore'),
            Column::make('ChildHave', 'ChildHave'),
            Column::make('ChildHaveNodata', 'ChildHaveNodata')
                ->sortable()
                ->searchable(),

            Column::make('InfertCase', 'InfertCase')
                ->sortable()
                ->searchable(),

            Column::make('ContraBefore', 'ContraBefore')
                ->sortable()
                ->searchable(),

            Column::make('NameContra', 'NameContra')
                ->sortable()
                ->searchable(),

            Column::make('ContraceptionUsed', 'ContraceptionUsed'),
            Column::make('ContraceptionType', 'ContraceptionType'),
            Column::make('DateCreated', 'DateCreated_formatted', 'DateCreated')
                ->sortable(),

            Column::make('CreatedBy', 'CreatedBy')
                ->sortable()
                ->searchable(),

            Column::make('DateModified', 'DateModified_formatted', 'DateModified')
                ->sortable(),

            Column::make('ModifiedBy', 'ModifiedBy')
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
            Filter::inputText('ClinicNo')->operators(['contains']),
            Filter::datetimepicker('CaseCardDate'),
            Filter::inputText('FirstName')->operators(['contains']),
            Filter::inputText('LastName')->operators(['contains']),
            Filter::inputText('PatientNID')->operators(['contains']),
            Filter::inputText('PatientDP')->operators(['contains']),
            Filter::inputText('PatientPassportNo')->operators(['contains']),
            Filter::inputText('FormerRegistrationNumber')->operators(['contains']),
            Filter::inputText('FormerClinicNumber')->operators(['contains']),
            Filter::inputText('StreetName')->operators(['contains']),
            Filter::inputText('CityName')->operators(['contains']),
            Filter::inputText('Country')->operators(['contains']),
            Filter::inputText('ChStreetName')->operators(['contains']),
            Filter::inputText('ChCityName')->operators(['contains']),
            Filter::inputText('TelephoneContact')->operators(['contains']),
            Filter::datetimepicker('DateOfBirth'),
            Filter::inputText('HouseHoldIncomeOcc')->operators(['contains']),
            Filter::inputText('ClinicInfluence')->operators(['contains']),
            Filter::inputText('OutLastPrenancy')->operators(['contains']),
            Filter::inputText('ChildHaveNodata')->operators(['contains']),
            Filter::inputText('InfertCase')->operators(['contains']),
            Filter::inputText('ContraBefore')->operators(['contains']),
            Filter::inputText('NameContra')->operators(['contains']),
            Filter::datetimepicker('DateCreated'),
            Filter::inputText('CreatedBy')->operators(['contains']),
            Filter::datetimepicker('DateModified'),
            Filter::inputText('ModifiedBy')->operators(['contains']),
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

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('patient.edit', function(\App\Models\Patient $model) {
                    return $model->id;
               }),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('patient.destroy', function(\App\Models\Patient $model) {
                    return $model->id;
               })
               ->method('delete')
        ];
    }
    */

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
