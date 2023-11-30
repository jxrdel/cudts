<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IUCDInsert extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'iucdinsert';

    protected $primaryKey = 'IUCDCode';

    protected $fillable = [
        'IUCDCode',
        'IUCDAction',
    ];
}
