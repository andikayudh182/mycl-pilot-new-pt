<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Produksi extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'mylea_produksi';

    protected $fillable = [
        'user_id',
        'KodeProduksi',
        'TanggalProduksi',
        'TanggalElus',
        'JamMulai',
        'JamSelesai',
        'Jumlah',
        'StatusPanen',
        'Keterangan',
        'Method',
        'Tray',
        'SubstrateQty',
    ];

    public $sortable = [
        'user_id',
        'KodeProduksi',
        'TanggalProduksi',
        'TanggalElus',
        'JamMulai',
        'JamSelesai',
        'Jumlah',
        'StatusPanen',
        'Konta',
        'Keterangan',
        'Method',
        'Tray',
        'SubstrateQty'
    ];
}
