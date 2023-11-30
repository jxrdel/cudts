<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'religion';

    protected $primaryKey = 'RegCode';

    protected $fillable = [
        'RegCode',
        'RegName',
    ];
}
