<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable =[

        'buildingKeyCode',
        'buildingKeyName',
        'numberOfLevels',
        'levelsCount'
    ];

    /**
     * A building belongs on a street
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
    public function street()
    {
        return $this->belongsTo('App\Street');
    }

    /**
     * A building has many building_levels
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function levels()
    {
        return $this->hasMany('App\Building_level');
    }

}
