<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PTKerik extends Model
{
    use HasFactory;

    protected $table = 'post_treatment_kerik';
    protected $fillable = [
        'PanenID',
        'Tanggal',
        'Jumlah',
        'RejectBeforeKerik',
        'RejectAfterKerik',
    ];

    public function Panen(): BelongsTo
    {
        return $this->belongsTo(Panen::class);
    }
}
