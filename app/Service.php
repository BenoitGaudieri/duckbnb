<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // protected $fillable = [];

    // Built-in feature of laravel to let a model know that a model a linked model has changed
    protected $touches = ["apartments"];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function apartments()
    {
        return $this->belongsToMany('App\Apartment');
    }
}
