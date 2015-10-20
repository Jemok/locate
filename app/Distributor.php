<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    /**
     * The fields that are mass assigned
     * @var array
     *
     *
     */
    protected $fillable = [

        'distributorId',
        'distributorName'

    ];

    /**
     * A distributor belongs to a single user
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
