<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    /**
     * The fields that can be mass assigned
     * @var array
     */
    protected $fillable = [

        'streetKeyCode',
        'streetKeyName',
        'streetDescription',
        'buildingStatus',
        'buildingCount'

    ];

    /**
     * A street is managed by a single agent
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    /**public function agent()
    {
        return $this->belongsTo('App\Agent');
    }**/

    /**
     * A street is managed by a single agent
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * A street has many buildings
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function building()
    {
        return $this->hasMany('App\Building');
    }
}
