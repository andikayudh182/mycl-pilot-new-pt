<?php

namespace App\Models\Baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontaminasi extends Model
{
    use HasFactory;

    
    protected $table = 'baglog_kontaminasi';

    protected $fillable = [
        'user_id',
        'KodeProduksi',
        'NoBibit',
        'JumlahKonta',
        'TanggalKonta',
        'Keterangan',
    ];
}
