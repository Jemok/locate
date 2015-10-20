<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcel_step extends Model
{
    protected $fillable = [

        'parcelStep'

    ];

    /**
     * A parcel_step belongs to a parcel
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parcel()
    {
        return $this->belongsTo('App\Parcel');
    }
}
