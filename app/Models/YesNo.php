<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YesNo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'yesno';

    protected $primaryKey = 'YesNoCode';

    protected $fillable = [
        'YesNoCode',
        'YesNoValue',
    ];
}
