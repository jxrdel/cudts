<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyRegister extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'dailyregister';

    protected $primaryKey = 'DailyRegisterID';

    protected $fillable = [
        'DailyRegisterID',
        'Date',
        'FacilityID',
        'DateCreated',
        'CreatedBy',
        'DateModified',
        'ModifiedBy',
    ];
}
