<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/8/15
 * Time: 2:50 PM
 */

namespace App\Repos;

use App\Street;


class StreetRepository
{
    /**
     * This street repository
     * @var \App\Street
     */
    private $street;

    /**
     * Initializes the street repository class
     * @param Street $streetModel
     */
    public function __construct(Street $streetModel)
    {
        $this->street = $streetModel;
    }

    /**
     * Commit a street to the database
     * @param $request
     */
    public function persist($request)
    {
        $agent = \App\User::findOrFail(\Auth::user()->id);

        $agent->street()->create([

            'streetKeyCode' => $request->streetKeyCode,
            'streetKeyName' => $request->streetKeyCode,
            'streetDescription' => $request->streetDescription,
            'buildingCount'  => 0

        ]);


        $this->updateAgentStreetCountAdd($agent);
    }

    /**
     * Returns all the streets belonging to an agent
     * @return mixed
     */

    public function getAgentStreets()
    {
        return \App\User::findOrFail(\Auth::user()->id)->street()->latest()->get();
    }


    /**
     * Add an agents number of streets by one
     * @param $agent
     */
    public function updateAgentStreetCountAdd($agent)
    {
        $agent->update([

            'streetCount' => ($agent->streetCount) + 1
        ]);
    }

    /**
     * Minus an agents number of street by one
     * @param $agent
     */
    public function updateAgentStreetCountMinus($agent)
    {
        $agent->update([

           'streetCount' => ($agent->streetCount) - 1
        ]);
    }

    /**
     * Returns a singe street belonging to an agent
     * @param $id
     * @return mixed
     */
    public function getSingleStreet($id)
    {
       $agent = \App\User::findOrFail(\Auth::user()->id);


        return $agent->street()
                     ->where('id', '=', $id)
                     ->first();
    }

    /**
     * Updates the details of a street
     * @param $request
     * @param $id
     */
    public function updateStreet($request, $id)
    {

        $agent = \App\User::findOrFail(\Auth::user()->id);

        $agent->street()
              ->where('id', '=', $id)
              ->update([

               'streetKeyName' => $request->streetKeyName,
               'streetKeyCode' => $request->streetKeyCode,
               'streetDescription' => $request->streetDescription

            ]);
    }

    /**
     * Removes a street from the database completely
     * @param $id
     */
    public function delete($id)
    {

        $agent = \App\User::findOrFail(\Auth::user()->id);

        $this->updateAgentStreetCountMinus($agent);

        $agent->street()->where('id', '=', $id)
                       ->delete();
    }

    /**
     * Close up a street
     * @param $id
     */
    public function close($id)
    {
        $street = $this->street->where('id', '=', $id)->first();

        $street->update([

            'buildingStatus' => 2
        ]);
    }

    /**
     * Open up a street
     * @param $id
     */
    public function open($id)
    {
        $street = $this->street->where('id', '=', $id)->first();

        $street->update([

            'buildingStatus' => 1
        ]);
    }

    /**
     * Get a streets buildings
     * @param $id
     */
    public function buildings($id)
    {
        $street = $this->street
                       ->where('id', '=', $id)
                       ->first();
        return $street->building()->get();
    }

    /**
     * Returns the name of a street
     * @param $id
     * @return mixed
     */

    public function getStreetName($id)
    {
        $street = $this->street
            ->where('id', '=', $id)
            ->first();
        return $street->streetKeyName;
    }

} 