<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PregnancyOutcome extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'outlastpregnancy';

    protected $primaryKey = 'LastPregCode';

    protected $fillable = [
        'LastPregCode',
        'LastPregStatus',
    ];
}
