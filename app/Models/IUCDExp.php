<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IUCDExp extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'iucdexp';

    protected $primaryKey = 'IUCDExpCo';

    protected $fillable = [
        'IUCDExpCo',
        'IUCDExpAct',
    ];
}
