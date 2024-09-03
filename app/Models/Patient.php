<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $primaryKey = 'PatCliNumber';

    protected $table = 'patient';

    public $incrementing = true;

    public $timestamps = false;

    protected $keyType = 'string';



    protected $fillable = [
        'PatCliNumber',
        'RegistrationNumber',
        'ClinicNo',
        'CaseCardDate',
        'FirstName',
        'LastName',
        'PatientNID',
        'PatientDP',
        'PatientPassportNo',
        'FormerRegistrationNumber',
        'FormerClinicNumber',
        'Gender',
        'Age',
        'StreetName',
        'CityName',
        'Country',
        'ChStreetName',
        'ChCityName',
        'TelephoneContact',
        'DateOfBirth',
        'EthicGroup',
        'Religion',
        'EduAttainment',
        'UniStatus',
        'EmpStatus',
        'HouseHoldIncomeOcc',
        'HouseHoldIncomeRange',
        'ClinicInfluence',
        'NumPregnancies',
        'NumLiveBirths',
        'NumChildAlive',
        'YrLastPregnancy',
        'GestWeeks',
        'OutLastPrenancy',
        'ChildMore',
        'ChildHave',
        'ChildHaveNodata',
        'InfertCase',
        'ContraBefore',
        'NameContra',
        'ContraceptionUsed',
        'ContraceptionType',
        'DateCreated',
        'CreatedBy',
        'DateModified',
        'ModifiedBy',
    ];
}
