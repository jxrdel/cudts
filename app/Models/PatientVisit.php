<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientVisit extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'patientvisits';

    protected $primaryKey = 'PatientVisitID';

    protected $fillable = [
        'PatientVisitID',
        'DailyRegisterID',
        'PatCliNumber',
        'CaseType',
        'SeenBy',
        'IUCDIns',
        'IUCDExp',
        'TL',
        'Vasectomy',
        'PapSmearTest',
        'PapSmearReport',
        'ProstateTest',
        'ProstateReport',
        'PregnancyTest',
        'CondomQuantity',
        'FoamTabQuantity',
        'PillQuantity',
        'InjectionQuantity',
        'IUCDQuantity',
        'Counselling',
        'Other',
        'TransferType',
        'DateCreated',
        'CreatedBy',
        'DateModified',
        'ModifiedBy',
    ];
}
