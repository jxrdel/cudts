<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PregnancyTest extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'pregnancytest';

    protected $primaryKey = 'PregTestCode';

    protected $fillable = [
        'PregTestCode',
        'PregTestStat',
    ];
}
