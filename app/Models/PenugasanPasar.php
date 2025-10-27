<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenugasanPasar extends Model
{
    use HasFactory;

    protected $table = 'penugasan_pasar';

    protected $guarded = ['id'];

    public function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
