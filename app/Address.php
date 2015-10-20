<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable =[

        'address',
        'agent_id'

    ];

    /**
     * An address belongs to a single location
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
        return $this->belongsTo('App\Location', 'address_id');
    }

    /**
     * An address has only one usage
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usage()
    {
        return $this->hasOne('App\Usage', 'address_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function track()
    {
        return $this->hasOne('App\Track_ship');
    }
}
