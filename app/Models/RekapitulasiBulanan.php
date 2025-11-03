<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapitulasiBulanan extends Model
{
    use HasFactory;

    protected $table = 'rekapitulasi_bulanan';

    protected $guarded = ['id'];

    public function komoditas()
    {
        return $this->belongsTo(Komoditas::class);
    }
}
