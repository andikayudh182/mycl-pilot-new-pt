<?php

namespace App\Models\Environment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemperatureHumidityWstation extends Model
{
    use HasFactory;

    protected $table = 'temperature_humidity_wstation';

    protected $fillable = [
        'Time',
        'Temperature',
        'Humidity',
    ];
}
