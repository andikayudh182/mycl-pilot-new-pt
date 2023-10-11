<?php

namespace App\Models\Environment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemperatureHumidity extends Model
{
    use HasFactory;

    protected $table = 'temperature_humidity';

    protected $fillable = [
        'Time',
        'Temperature',
        'Humidity',
    ];
}
