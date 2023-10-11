<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostTreatment extends Model
{
    use HasFactory;
    use Sortable;
    
    protected $table = 'post_treatment';

    protected $fillable = [
        'user_id',
        'Tanggal',
        'Batch',
        'Jumlah',
        'Status',
    ];

    public $sortable = [
        'user_id',
        'Tanggal',
        'Batch',
        'Jumlah',
    ];
}
