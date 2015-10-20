<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track_ship extends Model
{
    protected $fillable = [

        'sender_id',
        'sender_address',
        'receiver_id',
        'agent_sender',
        'receiver_address',
        'agent_receiver',
        'ship_status'

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parcel()
    {
        return $this->belongsTo('App\Parcel');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo('App\Address', 'sender_address');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address_receiver()
    {
        return $this->belongsTo('App\Address', 'receiver_address');
    }
}
