<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontaminasi extends Model
{
    use HasFactory;
    protected $table = 'mylea_kontaminasi';

    protected $fillable = [
        'user_id',
        'TanggalKontaminasi',
        'KPMylea',
        'KPBaglog',
        'Jumlah',
        'NoBibit',
        'KondisiBaglog',
        'Keterangan',
    ];
}
