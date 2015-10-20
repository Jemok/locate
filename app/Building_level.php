<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building_level extends Model
{

    /**
     * The fields that can be mass assigned
     * @var array
     */

    protected $fillable = [

       'building_id',
       'level_id',
        'levelName'

   ];

    /**
     * The table used by this model
     * @var string
     */
    protected $table = 'building_levels';


    /**
     * A building level belongs to a building
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function building()
    {
        return $this->belongsTo('App\Building');
    }

    /**
     * A building_level has many locations
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locations()
    {
        return $this->hasMany('App\Location', 'level_id');
    }
}
