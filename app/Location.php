<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [

        'locationKeyCode',
        'locationKeyName'

    ];

    /**
     * A location belongs to a single building_level
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function level_building()
    {
        return $this->hasOne('App\Building_level');
    }

    /**
     * A location has only one address
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function address()
    {
        return $this->hasOne('App\Address', 'location_id');
    }
}
