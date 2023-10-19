<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Curing extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'curing';

    
    protected $fillable = [
        'PT_ID',
        'ActualFinishCuring',
        'TanggalPengerjaan',
        'Warna',
        'SizeSatu',
        'SizeDua',
        'SizeTiga',
    ];

    public $sortable = [
        'PT_ID',
        'ActualFinishCuring',
        'TanggalPengerjaan',
        'Warna',
        'SizeSatu',
        'SizeDua',
        'SizeTiga',
    ];


}
