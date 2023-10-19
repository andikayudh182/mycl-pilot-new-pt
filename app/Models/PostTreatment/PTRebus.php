<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PTRebus extends Model
{
    use HasFactory;
    use Sortable;
    
    protected $table = 'post_treatment_rebus';

    protected $fillable = [
        'PanenID',
        'Tanggal',
        'JumlahRebus',
        
    ];

    public $sortable = [
        'PanenID',
        'Tanggal',
        'JumlahRebus',
    ];

    // public function Panen(): BelongsTo
    // {
    //     return $this->belongsTo(Panen::class);
    // }
}
