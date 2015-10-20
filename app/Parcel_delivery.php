<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcel_delivery extends Model
{
    protected $fillable = [

        'parcelDeliveryDate'

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parcel()
    {
        return $this->belongsTo('App\Parcel');
    }
}
