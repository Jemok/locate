<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/3/15
 * Time: 5:39 PM
 */

namespace App\Repos;

use App\Citizen;

use App\User;

use App\Address;



class CitizenRepository {

    /**
     * The citizen model
     * @var
     */
    private $citizen;

    /**
     * @param Citizen $citizenModel
     */

    private $user;

    /**
     * This address model
     * @var
     */
    private $address;

    /**
     * This class constructor initializer
     * @param Citizen $citizenModel
     * @param User $userModel
     * @param Address $addressModel
     */
    public function __construct(Citizen $citizenModel, User $userModel, Address $addressModel)
    {
      $this->citizen = $citizenModel;

      $this->user   = $userModel;

      $this->address = $addressModel;
    }

    /**
     * Persists a new citizen into the database
     * @param $request
     */
    public function register($request)
    {

       \Auth::user()->citizen()->create([

            'nationalId' => $request->nationalId,
            'firstName'  => $request->firstName,
            'secondName' => $request->secondName,
            'thirdName'  => $request->thirdName,
            'dateOfBirth'=> $request->dateOfBirth,
            'mobileNumber'=> $request->mobileNumber,
            'otherMobileNumber' => $request->otherMobileNumber,
        ]);

        \Auth::user()->update([
                'clientCitizen' => 1
            ]);
    }

    /**
     * Update the status of the authenticated citizen
     * @param $request
     * @param $id
     */

    public function update($request, $id)
    {

        \Auth::user()->citizen()
                     ->where('id', '=', $id)
                     ->update([

                    'nationalId' => $request->nationalId,
                    'firstName'  => $request->firstName,
                    'secondName' => $request->secondName,
                    'thirdName'  => $request->thirdName,
                    'dateOfBirth'=> $request->dateOfBirth,
                    'mobileNumber'=> $request->mobileNumber,
                    'otherMobileNumber' => $request->otherMobileNumber,
            ]);
    }

    /**
     * Get the citizen details of the logged in user
     * @return mixed
     */

    public function getCitizenDetails()
    {
        return \Auth::user()->citizen()->first();
    }

    /**
     * Get the address of a user
     * @return mixed
     */
    public function getCitizenAddresses()
    {
        $addresses = \App\Usage::where('user_id', '=', \Auth::user()->id);

        return $addresses;
    }
} 