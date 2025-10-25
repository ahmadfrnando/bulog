<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasar extends Model
{
    use HasFactory;

    protected $table = 'pasar';

    protected $guarded = [];

    public function getGoogleMapsUrlAttribute(): ?string
    {
        if ($this->lat && $this->lng) {
            return 'https://www.google.com/maps/search/?api=1&query='
                . urlencode($this->lat . ',' . $this->lng);
        }
        return null;
    }

    public function toko()
    {
        return $this->hasMany(Toko::class);
    }
}
