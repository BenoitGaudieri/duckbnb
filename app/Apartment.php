<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Apartment extends Model
{
    use Searchable;

    // Built-in feature of laravel to let a model know that a model a linked model has changed
    protected $touches = ["services"];

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'room_qty',
        'bathroom_qty',
        'bed_qty',
        'sqr_meters',
        'img_url',
        'lat',
        'lng',
        'views',
        'is_visible'
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sponsorships()
    {
        return $this->belongsToMany('App\Sponsorship')->withTimestamps();
    }

    /**
     * Scout Extended transforms the model into Algolia records with this toSearchableArray method.
     * Returning the services and the lat/lng in the _geoloc object used by Algolia. 
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array = $this->transform($array);

        $array["services"] = $this->services->map(function ($data) {
            return $data['name'];
        })->toArray();

        $array['_geoloc'] = [
            'lat' => (float) $array['lat'],
            'lng' => (float) $array['lng'],
        ];

        return $array;
    }
}
