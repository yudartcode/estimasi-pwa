<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Lengan extends Model
{
    protected $table = "lengan";

    protected $fillable = [
        'nama', 'meter_kain', 'biaya'
    ];
}