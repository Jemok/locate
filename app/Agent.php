<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = [

        'businessNumber',
        'agentName',
        'agentEmail',
        'agentMobileNumber',
        'openingHourWeekDay',
        'closingHourWeekDay',
        'openingHourSaturday',
        'closingHourSaturday',
        'openingHourSunday',
        'closingHourSunday',
        'streetCount'
    ];

    /**
     * An agent belongs to a single user
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * An agent manages many streets
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /**public function street()
    {
        return $this->hasMany('App\Street');
    }**/
}
