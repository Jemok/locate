<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcel_receiver extends Model
{
    protected $fillable = [

        'emailReceiver',
        'user_id',
        'receiver_id'

    ];

    /**
     * A parcel_receiver belongs to a single parcel
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parcel()
    {
        return $this->belongsTo('App\Parcel');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
