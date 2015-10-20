<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{


    /**
     * The fields that can be mass assigned
     * @var array
     */
    protected $fillable = [

        'parcelName',
        'parcelWeight',
        'parcelCategory',
        'parcelStatus',
        'parcelPendingStatus',
        'parcelStep',
        'receiver_id'

    ];

    /**
     * A parcel belongs to a single user who sent it
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * A parcel has one parcel receiver
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function receiver()
    {
        return $this->hasOne('App\Parcel_receiver');
    }

    /**
     * A parcel has one parcel step
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parcel_step()
    {
        return $this->hasOne('App\Parcel_step');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function delivery()
    {
        return $this->hasOne('App\Parcel_delivery');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function quotation()
    {
        return $this->hasOne('App\Parcel_quotation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function track()
    {
        return $this->hasOne('App\Track_ship');
    }

}
