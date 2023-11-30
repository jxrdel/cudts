<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnionStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'unionstatus';

    protected $primaryKey = 'UnionCode';

    protected $fillable = [
        'UnionCode',
        'UnionStatus',
    ];
}
