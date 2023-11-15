<?php

namespace App\Models\PostTreatment;

use App\Models\Mylea\Panen;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kyslik\ColumnSortable\Sortable;

class PostTreatmentDetails extends Model
{
    use HasFactory;
    use Sortable;
    
    protected $table = 'post_treatment_details';

    protected $fillable = [
        'id',
        'PT_ID',
        'Panen_ID',
        'Jumlah',
    ];

    public $sortable = [
        'id',
        'PT_ID',
        'Panen_ID',
        'Jumlah',
    ];

    public function PostTreatment(): BelongsTo
    {
        return $this->belongsTo(Panen::class);
    }

}
