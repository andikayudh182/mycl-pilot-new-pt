<?php

namespace App\Models\Environment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemperatureHumidityMylea extends Model
{
    use HasFactory;
    
    protected $table = 'temperature_humidity_mylea';

    protected $fillable = [
        'Time',
        'Temperature',
        'Humidity',
    ];
}
