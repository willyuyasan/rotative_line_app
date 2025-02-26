<?php

namespace App\Models;

use Spatie\Permission\Models\Role as ModelsRole; //Use this for extend the preconfigurated model role of spatie
//use Illuminate\Database\Eloquent\Model;

class Role extends ModelsRole
{
    //
    protected $guard_name = 'api';
}
