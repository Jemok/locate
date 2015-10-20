<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/11/15
 * Time: 11:23 AM
 */

namespace App\Repos;

use App\Address;

class AddressRepository
{
    /**
     * This address model
     * @var \App\Address
     */
    private $address;

    /**
     * This class constructor initializer
     * @param Address $addressModel
     */
    public function __construct(Address $addressModel)
    {
        $this->address = $addressModel;
    }

    /**
     * Set a the authenticated citizen as belonging to an address
     * @param $address_id
     * @param $user_id
     */
    public function useAddress($address_id, $user_id)
    {
        \Auth::user()->usage()->create([

            'address_id' => $address_id,
            'usageStatus' => 1
        ]);
    }

    /**
     * Unset the authenticated citizen as not a member of an address
     * @param $address_id
     */
    public function unUseAddress($address_id)
    {
        $user = \Auth::user();

        $usage = $user->usage()->where('address_id', '=', $address_id)
                               ->where('user_id', '=', \Auth::user()->id);
        $usage->delete();
    }

    /**
     * Set a citizens address active or inactive
     * @param $usage_id
     */
    public function setUsage($usage_id)
    {
        if(\App\Usage::where('user_id', '=', \Auth::user()->id)
                         ->where('usageActivity', '=', 1)->first())
        {
            $usage = \App\Usage::where('user_id', '=', \Auth::user()->id)
                ->where('usageActivity', '=', 1)->first();

            $usage->update([

                'usageActivity' => 0
            ]);
        }

        if(!(\App\Usage::where('user_id', '=', \Auth::user()->id)
            ->where('usageActivity', '=', 1)->first()))
        {
            $usage = \App\Usage::where('id', '=', $usage_id)
                ->where('user_id', '=', \Auth::user()->id)
                ->where('usageActivity', '=', 0)->first();

            $usage->update([

                'usageActivity' => 1
            ]);
        }
    }
} 