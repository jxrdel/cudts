<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseIncOcc extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'householdincomeocc';

    protected $primaryKey = 'OccurenceCode';

    protected $fillable = [
        'OccurenceCode',
        'HouseHoldIncomeOcc',
        'Description',
    ];
}
