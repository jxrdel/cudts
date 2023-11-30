<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ethnicity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'ethnicgroup';

    protected $primaryKey = 'Code';

    protected $fillable = [
        'Code',
        'Decent',
    ];
}
