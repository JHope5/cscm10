<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{    
    /*
     *  Get the lecturer the project belongs to
     */
    public function lecturer() {
        return $this->belongsTo('App\Lecturer');
    }

    /*
     *  Get the student the project is assigned to
     */
    public function student() {
        return $this->belongsTo('App\Student');
    }
}
