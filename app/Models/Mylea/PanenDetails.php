<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanenDetails extends Model
{
    use HasFactory;
    protected $table = 'mylea_panen_details';

    protected $fillable = [
        'user_id',
        'PanenID',
        'KPBaglog',
        'Jumlah',
        'Reject',
        'NoBibit',
        'KondisiBaglog',
        'Keterangan',
    ];
}
