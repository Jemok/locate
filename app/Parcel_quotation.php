<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcel_quotation extends Model
{
    protected $table = 'quotations';

    protected $fillable = [
        'quotationPrice',
        'trackCode',
        'user_id'
    ];

    public function parcel()
    {
        $this->belongsTo('App\Parcel');
    }
}
