<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoneReferred extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'doneorreferred';

    protected $primaryKey = 'DoRefCode';

    protected $fillable = [
        'DoRefCode',
        'DoRefAction',
    ];
}
