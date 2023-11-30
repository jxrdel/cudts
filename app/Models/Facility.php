<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'facility';

    protected $primaryKey = 'FacilityID';

    protected $fillable = [
        'FacilityID',
        'FacilityName',
        'CountyCode',
        'FacilityType',
        'RHACode',
        'MunicipalityCode',
    ];
}
