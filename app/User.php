<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level',
        'email',
        'password',
        'clientCitizen',
        'streetCount'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function citizen()
    {
        return $this->hasOne('App\Citizen');
    }

    /**
     * An user is a single agent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function agent()
    {
        return $this->hasMany('App\Agent');
    }

    /**
     * A user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distributor()
    {
        return $this->hasMany('App\Distributor');
    }

    /**
     * A user has only one active address for usage
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usage()
    {
        return $this->hasOne('App\Usage');
    }

    /**
     * A user has many parcels
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parcel()
    {
        return $this->hasMany('App\Parcel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function track()
    {
        return $this->hasMany('App\Track_ship');
    }

    /**
     * An agent manages many streets
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function street()
    {
        return $this->hasMany('App\Street', 'agent_id');
    }
}
