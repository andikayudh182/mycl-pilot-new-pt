<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Reinforce extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'reinforce';

    
    protected $fillable = [
        'id',
        'CuringID',
        'TanggalPengerjaan',
        'Jenis',
        'Jumlah',
        'Size'
    ];

    public $sortable = [
        'id',
        'CuringID',
        'TanggalPengerjaan',
        'Jumlah',
        'Jenis',
        'Size'
    ];
}
