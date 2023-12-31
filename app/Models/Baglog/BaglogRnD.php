<?php

namespace App\Models\Baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaglogRnD extends Model
{
    use HasFactory;

    protected $table = 'baglog_rnd';

    protected $fillable = [
        'user_id',
        'KodeProduksi',
        'Departemen',
        'JenisResep',
        'TanggalBaglog',
        'Jumlah',
        'Keterangan',
        'StatusArchive',
    ];
}
