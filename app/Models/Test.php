<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'test';

    protected $primaryKey = 'TestCode';

    protected $fillable = [
        'TestCode',
        'TestAction',
        'Description',
    ];
}
