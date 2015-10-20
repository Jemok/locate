<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{

    /**
     * The table to be used b this model
     * @var string
     */
    protected $table = 'usages';

    /**
     * The fields that can be mass assigned
     * @var array
     */
    protected $fillable = [

        'address_id',
        'usageStatus',
        'usageActivity'
    ];

    /**
     * A usage belongs to a user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * A usage also belongs to an address
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo('App\Address', 'address_id');
    }
}


