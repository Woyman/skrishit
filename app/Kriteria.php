<?php


namespace App;

use Jenssegers\Mongodb\Eloquent\Model;


class Kriteria extends Model
{
    protected $collection = 'kriteria';

    protected $fillable = [
        'kriteria_name'        
    ];

}
