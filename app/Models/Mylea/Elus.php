<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elus extends Model
{
    use HasFactory;

    protected $table = 'mylea_elus';

    protected $fillable = [
        'user_id',
        'TanggalElus',
        'KPMylea',
        'JamMulai',
        'JamSelesai',
        'Jumlah',
        'Path',
    ];
}
