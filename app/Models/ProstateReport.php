<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProstateReport extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'prostatereport';

    protected $primaryKey = 'ProsRepCode';

    protected $fillable = [
        'ProsRepCode',
        'ProsRepRes',
    ];
}
