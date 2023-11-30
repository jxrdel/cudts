<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContraceptiveType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'contraceptivetype';

    protected $primaryKey = 'ContraceptiveTypeID';

    protected $fillable = [
        'ContraceptiveTypeID',
        'ContraceptiveType',
        'Comments',
        'UnitType',
    ];
}
