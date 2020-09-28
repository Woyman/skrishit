<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;


class Speciality extends Model
{
    protected $collection = 'speciality';

    protected $fillable = [
        'speciality_name'        
    ];

}
