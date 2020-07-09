<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    public $timestamps = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function apartments()
    {
        return $this->belongsToMany('App\Apartment');
    }
}
