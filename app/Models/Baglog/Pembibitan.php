<?php

namespace App\Models\Baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Pembibitan extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'baglog_pembibitan';

    protected $fillable = [
        'user_id',
        'KodeProduksi',
        'TanggalPengerjaan',
        'Batch',
        'TanggalSterilisasi',
        'sterilisasi_id',
        'JumlahBaglog',
        'Lokasi',
        'Kondisi',
        'BibitTerpakai',
        'BibitReject',
        'TanggalCrushing',
        'StatusCrushing',
        'TanggalPanen',
        'StatusPanen',
        'BatchBibitTerpakai',
        'BatchBibitDibuang',
        'KodeBibit',
        'StatusArchive',
    ];

    public $sortable = [
        'user_id',
        'KodeProduksi',
        'TanggalPengerjaan',
        'Batch',
        'TanggalSterilisasi',
        'sterilisasi_id',
        'JumlahBaglog',
        'Lokasi',
        'Kondisi',
        'BibitTerpakai',
        'BibitReject',
        'TanggalCrushing',
        'StatusCrushing',
        'TanggalPanen',
        'StatusPanen',
        'BatchBibitTerpakai',
        'BatchBibitDibuang',
        'KodeBibit',
        'PersenKonta',
        'StatusArchive',
    ];
}
