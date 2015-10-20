<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/9/15
 * Time: 11:57 AM
 */

namespace App\Repos;

use App\Building;

use App\Street;


class BuildingRepository
{
    /**
     * This building model
     * @var \App\Building
     */
    private $building;

    /**
     * This street model
     * @var
     */
    private $street;

    /**
     * Constructor initializer
     * @param Building $buildingModel
     * @param Street $streetModel
     */

    public function __construct(Building $buildingModel, Street $streetModel)
    {
       $this->building = $buildingModel;

       $this->street = $streetModel;
    }

    /**
     * Add a building to the database
     * @param $request
     * @param $id
     */
    public function persist($request, $id)
    {
        $agent = \App\User::findOrFail(\Auth::user()->id);

        $street = $agent->street()
                        ->where('id', $id)
                        ->first();

        $street->building()->create([
            'buildingKeyCode' => $request->buildingKeyCode,
            'buildingKeyName' => $request->buildingKeyName,
            'numberOfLevels'  => $request->numberOfLevels,
            'levelsCount'     => 0
        ]);

        $this->updateStreetBuildingCountAdd($street);

        $this->updateBuildingStatus($id);
    }

    /**
     * Updates the number of buildings on a street
     * @param $street
     *
     */
    private function updateStreetBuildingCountAdd($street)
    {
       $street->update([

           'buildingCount' => ($street->buildingCount) + 1
       ]);
    }

    /**
     * Updates the number of buildings on a street
     * @param $street
     *
     */
    private function updateStreetBuildingCountMinus($street)
    {
        $street->update([

            'buildingCount' => ($street->buildingCount) - 1
        ]);
    }

    /**
     * Changes the building status
     * @param $id
     */
    private function updateBuildingStatus($id)
    {
        $street = $this->street->where('id', '=', $id)->first();
        $street->update([

            'buildingStatus' => 1
        ]);
    }

    /**
     * Gets the details of a building
     * @param $id
     * @return mixed
     */
    public function getBuildingDetails($id)
    {
        return $this->building->where('id', '=', $id)->first();
    }

    /**
     * Update the details od a building
     * @param $id
     * @param $request
     *
     */

    public function update($request, $id)
    {
        $building = $this->building->where('id', '=', $id)->first();

        $building->update([
            'buildingKeyCode' => $request->buildingKeyCode,
            'buildingKeyName' => $request->buildingKeyName
        ]);
    }

    /**
     * Get the id of a street
     * @param $id
     * @return mixed
     */
    public function getStreetBuilding($id)
    {
        $id = $this->building->where('id', '=', $id)->first()->street_id;

        $street = $this->street->findOrFail($id);

        return $street->id;
    }

    /**
     * Remove a system from the db completely
     * @param $id
     */
    public function delete($id)
    {
        $street_id = $this->getStreetBuilding($id);

        $street = $this->street->findOrFail($street_id);

        $this->updateStreetBuildingCountMinus($street);

        $this->building->where('id', '=', $id)->delete();

    }

    /**
     * Gets a building's number of levels
     * @param $id
     * @return mixed
     */
    public function getNumberOfLevels($id)
    {
        return $this->building->where('id', '=', $id)->first()->numberOfLevels;
    }

    /**
     * Get the number of levels that a building has
     * @param $id
     * @return mixed
     */
    public function getLevelsCount($id)
    {
        return $this->building->where('id', '=', $id)->first()->levelsCount;
    }
} 