<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    /**
     * The fields that can be mass assigned
     * @var array
     */
    protected $fillable = [

        'levelName',
        'levelsCount'

    ];

    /**
     * A level can have many building-levels
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function building()
    {
        return $this->belongsToMany('App\Building', 'building_levels');
    }

}
