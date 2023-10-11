<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardQuaterTarget extends Model
{
    use HasFactory;
    protected $table = 'dashboard_target_quartal';

    protected $fillable = [
        'Title',
        'Q1',
        'Q2',
        'Q3',
        'Q4',
    ];
}
