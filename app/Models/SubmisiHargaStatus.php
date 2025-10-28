<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmisiHargaStatus extends Model
{
    use HasFactory;

    protected $table = 'submisi_harga_status';
    protected $guarded = [];

    public function submisi_harga()
    {
        return $this->belongsTo(SubmisiHarga::class);
    }

    public function getStatus($status)
    {
        switch ($status) {
            case 'dikirim':
                $label = 'Data diinput';
                $color = 'warning';
                $desc = 'Data berhasil diinput oleh petugas';
                break;
            case 'diterbitkan':
                $label = 'Submisi diterbitkan';
                $color = 'success';
                $desc = 'Submisi berhasil diterbitkan oleh admin';
                break;
            case 'ditolak':
                $label = 'Submisi ditolak';
                $color = 'danger';
                $desc = 'Submisi berhasil ditolak oleh admin';
                break;
            case 'ditandai':
                $label = 'Data Submisi ditandai';
                $color = 'danger';
                $desc = 'Submisi berhasil ditandai oleh admin';
                break;
            case 'dikoreksi':
                $label = 'Data Submisi dikoreksi';
                $color = 'warning';
                $desc = 'Submisi berhasil dikoreksi oleh admin';
                break;
        }

        return [
            'label' => $label,
            'color' => $color,
            'desc' => $desc
        ];
    }
}
