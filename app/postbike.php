<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postbike extends Model
{
    protected $fillable = [
        'make','model', 'type','mileage','engine_size','drive_terrain','transmission','fuel_type','condition','price','contact','city','title','description','image','image2','image3','image4','image5','image6','image7','image8','vehicleType'
    ];
}
