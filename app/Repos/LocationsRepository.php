<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/10/15
 * Time: 8:16 PM
 */

namespace App\Repos;

use App\Location;

use App\Building_level;

use App\Address;

use App\Building;

use App\Street;

use App\User;

use App\Usage;


class LocationsRepository
{
    /**
     * This location model
     * @var \App\Location
     */
    private $location;

    /**
     * This building_level model
     * @var \App\Building_level
     */
    private $level_building;

    /**
     * This address model
     * @var \App\Address
     */
    private $address;

    /**
     * This building model
     * @var \App\Building
     */
    private $building;

    /**
     * This building model
     * @var \App\Street
     */
    private $street;

    /**
     * This agent model
     * @var \App\Agent
     */
    private $agent;

    /**
     * Agent ID
     * @var
     */
    private $agent_id;

    /**
     * This model usage
     * @var \App\Address
     */
    private $usage;

    /**
     * This class constructor initializer
     * @param Location $locationsModel
     * @param Building_level $building_levelModel
     * @param Address $addressModel
     * @param Building $buildingModel
     * @param Street $streetModel
     * @param Agent $agentModel
     * @param Usage $usageModel
     */

    public function __construct(Location $locationsModel, Building_level $building_levelModel, Address $addressModel, Building $buildingModel, Street $streetModel, User $userModel, Usage $usageModel)
    {
        $this->location = $locationsModel;

        $this->level_building = $building_levelModel;

        $this->address = $addressModel;

        $this->building = $buildingModel;

        $this->street = $streetModel;

        $this->agent = $userModel;

        $this->usage = $addressModel;
    }

    /**
     * Put an address in the db
     * @param $request
     * @param $id
     */
    public function persist($request, $id)
    {
        $level_building = $this->level_building->findOrFail($id);

        $location = $level_building->locations()->create([

            'locationKeyCode' => $request->locationKeyCode,
            'locationKeyName' => $request->locationKeyName
        ]);

        $this->persistAddress($location);
    }

    /**
     * Get all locations that belong to building_level
     * @param $id
     * @return mixed
     */
    public function getLocations($id)
    {
        return $this->location->where('level_id', '=', $id);
    }

    /**
     * Persist an address to the db
     * @param $location
     */
    private function persistAddress($location)
    {
       $location->address()->create([

           'address' => $this->generateAddress($location),
           'agent_id' => $this->agent_id

           ]);
    }

    /**
     * Generate an address for a location
     * @param $location
     * @return string
     */
    private function generateAddress($location)
    {
        $locationName =$location->locationKeyCode;

        $locationId = $location->id;

        $location = $this->location->findOrFail($locationId);

        $levelId = $location->level_id;

        $level = $this->level_building->findOrFail($levelId);

        $levelName = $level->levelName;

        $building_id = $level->building_id;

        $building = $this->building->findOrFail($building_id);

        $buildingName = $building->buildingKeyCode;

        $street_id = $building->street_id;



        $street = $this->street->findOrFail($street_id);

        $streetName = $street->streetKeyCode;

        $agent_id = $street->agent_id;


        $this->agent_id =$agent_id;


        //$agent = $this->agent->findOrFail($agent_id);

        $agentName = \App\Agent::where('user_id', '=', $agent_id)->first()->agentName;

        return $buildingName.$levelName.$locationName. "-" . $streetName . " ( ". $agentName . " ) ";
    }

    /**
     * Check whether a user is using an address
     * @param $address_id
     * @param $user_id
     * @return int
     */
    public function usage($address_id, $user_id)
    {
        if($this->usage->where('address_id', '=', $address_id)
                        ->where('user', '=', $user_id)->first())
        {
            return 1;
        }

        return 0;
    }
} 