<?php

namespace App\Models\Baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'baglog_resep';

    protected $fillable = [
        'Type',
        'TanggalResep',
        'BeratBaglog',
        'TotalBags',
        'SKayu',
        'MCSKayu',
        'NoKarungSKayu',
        'Tapioka',
        'MCTapioka',
        'Pollard',
        'MCPollard',
        'Kapur',
        'MCKapur',
        'Hickory',
        'MCHickory',
        'Air',
        'Approval',
        'Status',
        'user_id',
    ];
}
