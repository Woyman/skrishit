<?php


namespace App;

use Jenssegers\Mongodb\Eloquent\Model;


class Hero extends Model
{
    protected $collection = 'hero';

    // protected $fillable = [
    //     'role_name'        
    // ];

}
