<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PTProses extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'post_treatment_proses';
    protected $fillable = [
        'user_id',
        'Tanggal',
        'PT_ID',
        'JamMulai',
        'JamSelesai',
        'Proses',
        'Jumlah',
        'Reject',
        'Notes',
    ];

    public $sortable = [
        'user_id',
        'Tanggal',
        'PT_ID',
        'JamMulai',
        'JamSelesai',
        'Proses',
        'Jumlah',
        'Reject',
        'Notes',
    ];
}
