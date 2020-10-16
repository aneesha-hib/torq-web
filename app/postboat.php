<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postboat extends Model
{
    protected $fillable = [
        'type','make','condition','price','contact','city','title','description','image','image2','image3','image4','image5','image6','image7','image8','vehicleType'
    ];
}
