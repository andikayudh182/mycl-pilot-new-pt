<?php

namespace App\Models\Environment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemperatureHumidityBaglog extends Model
{
    use HasFactory;

    protected $table = 'temperature_humidity_baglog';

    protected $fillable = [
        'Time',
        'Temperature',
        'Humidity',
    ];
    
}
