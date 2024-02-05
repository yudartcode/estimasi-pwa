<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Kain extends Model
{
    protected $table = "kain";

    protected $fillable = [
        'nama', 'harga_per_meter', 'keterangan'
    ];
}