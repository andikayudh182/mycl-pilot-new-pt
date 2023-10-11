<?php

namespace App\Models\Baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemakaianSterilisasi extends Model
{
    use HasFactory;
    protected $table = 'baglog_pemakaian_sterilisasi';

    protected $fillable = [
        'SterilisasiID',
        'PembibitanID',
        'Jumlah'
    ];
}
