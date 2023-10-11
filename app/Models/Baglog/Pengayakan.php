<?php

namespace App\Models\Baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengayakan extends Model
{
    use HasFactory;

    protected $table = 'baglog_pengayakan';

    protected $fillable = [
        'TanggalPengerjaan',
        'NoKarung',
        'BeratAwal',
        'BeratAkhir',
        'NoKontainer',
        'user_id',
    ];
}
