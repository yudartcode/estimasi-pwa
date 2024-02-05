<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estimasi extends Model
{
    protected $table = "estimasi";

    protected $fillable = [
        'tipe_estimasi', 'kain_id', 'kemeja_id', 'ukuran_id', 'lengan_id', 'total_meter_kain', 'total_biaya', 'user_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function kain()
    {
        return $this->belongsTo(Kain::class, 'kain_id');
    }
    public function kemeja()
    {
        return $this->belongsTo(Kemeja::class, 'kemeja_id');
    }
    public function ukuran()
    {
        return $this->belongsTo(Ukuran::class, 'ukuran_id');
    }
    public function lengan()
    {
        return $this->belongsTo(Lengan::class, 'lengan_id');
    }
}