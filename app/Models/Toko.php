<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;

    protected $table = 'toko';
    protected $fillable=['pasar_id','nama_toko','nama_pemilik_toko','nomor_kios'];

    public function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }

}
