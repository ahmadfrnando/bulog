<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapitulasiHarian extends Model
{
    use HasFactory;

    protected $table = 'rekapitulasi_harian';
    protected $guarded = [];

    public function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }

    public function komoditas()
    {
        return $this->belongsTo(Komoditas::class);
    }
}
