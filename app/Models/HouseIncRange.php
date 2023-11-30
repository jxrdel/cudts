<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseIncRange extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'householdincomerate';

    protected $primaryKey = 'IncomeRateCode';

    protected $fillable = [
        'IncomeRateCode',
        'IncomeRate',
        'Description',
        'householdincomeratecol',
    ];
}
