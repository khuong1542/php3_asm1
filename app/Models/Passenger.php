<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
    protected $table = 'passengers';
    protected $fillable = [
        'name',
        'car_id',
        'travel_time',
    ];
    public function cars(){
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
}
