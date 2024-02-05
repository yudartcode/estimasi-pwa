<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kemeja extends Model
{
    protected $table = "kemeja";

    protected $fillable = [
        'nama', 'jenis', 'biaya'
    ];
}