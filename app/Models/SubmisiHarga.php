<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmisiHarga extends Model
{
    use HasFactory;

    protected $table = 'submisi_harga';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    public function komoditas()
    {
        return $this->belongsTo(Komoditas::class);
    }

    public function submisi_harga_status()
    {
        return $this->hasMany(SubmisiHargaStatus::class);
    }
}
