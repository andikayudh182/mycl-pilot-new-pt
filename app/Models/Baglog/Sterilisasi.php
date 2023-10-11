<?php

namespace App\Models\Baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Sterilisasi extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'baglog_sterilisasi';

    protected $fillable = [
        'user_id',
        'TanggalPengerjaan',
        'Batch',
        'NoAutoclave',
        'JamMulai',
        'JamSelesai',
        'JumlahBaglog',
        'Kondisi',
        'JumlahBaglogBerlubang',
        'JumlahTapeTidakHitam',
        'mixing_id',
        'pembibitan_kp',
    ];

    public $sortable = [
        'user_id',
        'TanggalPengerjaan',
        'Batch',
        'NoAutoclave',
        'JamMulai',
        'JamSelesai',
        'JumlahBaglog',
        'Kondisi',
        'JumlahBaglogBerlubang',
        'JumlahTapeTidakHitam',
        'mixing_id',
        'pembibitan_kp',
    ];
}
