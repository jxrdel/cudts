<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'sex';

    protected $primaryKey = 'SexCode';

    protected $fillable = [
        'SexCode',
        'Description',
    ];
}
