<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    /**
     * Use the citizens table in the database
     * @var string
     *
     */
    protected $table ="citizens";

    /**
     * The fields that can be mass assigned
     * @var array
     */

    protected $fillable = [

        'nationalId',
        'firstName',
        'secondName',
        'thirdName',
        'dateOfBirth',
        'mobileNumber',
        'otherMobileNumber'

    ];

    /**
     * A citizen belongs to a single user
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
