<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'employmentstatus';

    protected $primaryKey = 'EmployCode';

    protected $fillable = [
        'EmployCode',
        'EmployStatus',
    ];
}
