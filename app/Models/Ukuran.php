<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    protected $table = "ukuran";

    protected $fillable = [
        'nama', 'meter_kain', 'biaya'
    ];
}