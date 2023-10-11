<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\PostTreatment\PostTreatmentDetails;
use App\Models\PostTreatment\PTKerik;

class Panen extends Model
{
    use HasFactory;

    protected $table = 'mylea_panen';

    protected $fillable = [
        'user_id',
        'TanggalPanen',
        'KPMylea',
        'JamMulai',
        'JamSelesai',
        'Jumlah',
        'JumlahReject',
        'JenisPanen',
    ];

    public function PostTreatment(): HasMany
    {
        return $this->hasMany(PostTreatmentDetails::class, 'Panen_ID');
    }

    public function Kerik(): HasMany
    {
        return $this->hasMany(PTKerik::class, 'PanenID');
    }
}
