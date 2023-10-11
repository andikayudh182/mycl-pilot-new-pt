<?php

namespace App\Models\Baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Mixing extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'baglog_mixing';

    protected $fillable = [
        'user_id',
        'resep_id',
        'TanggalPengerjaan',
        'Batch',
        'JamMulai',
        'JamSelesai',
        'JumlahBaglog',
        'MCBaglog',
        'MCBaglogAkhir',
        'BeratAktual'
    ];
    public $sortable = [
        'user_id',
        'resep_id',
        'TanggalPengerjaan',
        'Batch',
        'JamMulai',
        'JamSelesai',
        'JumlahBaglog',
        'MCBaglog',
        'MCBaglogAkhir',
        'BeratAktual'
    ];
}
