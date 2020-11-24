<?php
namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Role extends Model
{
    protected $collection = 'role';

    protected $fillable = [
        'role_name'        
    ];

}
