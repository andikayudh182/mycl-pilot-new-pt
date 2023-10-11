<?php

namespace App\Models\Baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crushing extends Model
{
    use HasFactory;

    protected $table = 'baglog_crushing';

    protected $fillable = [
        'user_id',
        'KodeProduksi',
        'TanggalCrushing',
        'JamMulai',
        'JamSelesai',
        'KondisiBaglog',
        'JumlahBaglogPutih',
        'JumlahBaglogTidakTumbuh',
        'JumlahBaglogTidakMerata',
        'TotalBaglog',
    ];
}
