<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    /*
     *  Get the projects offered by the lecturer
     */
    public function projects() { 
        return $this->hasMany('App\Project');
    }
}
