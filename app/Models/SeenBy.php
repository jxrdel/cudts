<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeenBy extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'seenby';

    protected $primaryKey = 'SeenByID';

    protected $fillable = [
        'SeenByID',
        'SeenByCode',
        'SeenBy',
    ];
}
