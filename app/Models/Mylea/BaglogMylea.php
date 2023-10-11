<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaglogMylea extends Model
{
    use HasFactory;

    protected $table = 'mylea_baglog';

    protected $fillable = [
        'KPMylea',
        'KPBaglog',
        'JumlahBaglog',
        'KondisiBaglog',
    ];
}
