<?php

namespace App\Http\Controllers\Address;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repos\AddressRepository;

class AddressController extends Controller
{
    /**
     * This address repository
     * @var \App\Repos\AddressRepository
     */
    private $address;


    /**
     * The constructor initializer for this class
     * @param AddressRepository $addressRepository
     */
    public function __construct(AddressRepository $addressRepository)
    {
        $this->address = $addressRepository;
    }

    /**
     * Gets the manage address view that allows the citizen to add new agents and addresses
     * @return \Illuminate\View\View
     */
    public function manageAddress()
    {
        return view('address.manage');
    }

    /**
     * Sets an address as being used by a user
     * @param $address_id
     * @param $user_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function useAddress($address_id, $user_id)
    {
       $this->address->useAddress($address_id, $user_id);

       return redirect('/client/citizen/');
    }

    /**
     * Unsets an address being used by a use
     * @param $address_id
     * @param $user_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function unUseAddress($address_id, $user_id)
    {
       $this->address->unUseAddress($address_id, $user_id);

       return redirect('/address/manage/');
    }

    /**
     * Sets an citizens address as active and deactivates all the other addresses
     * @param $usage_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setUsageActivity($usage_id)
    {
        $this->address->setUsage($usage_id);

        return redirect('/client/citizen/');
    }
}
