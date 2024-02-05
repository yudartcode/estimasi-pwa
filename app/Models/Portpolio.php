<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Portpolio extends Model
{
    protected $table = "portpolio";

    protected $fillable = [
        'nama', 'jenis', 'bahan', 'lengan', 'biaya', 'foto'
    ];
}