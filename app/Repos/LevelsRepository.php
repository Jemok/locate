<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/10/15
 * Time: 11:38 AM
 */

namespace App\Repos;

use App\Level;

use App\Building;

use App\Building_level;


class LevelsRepository
{
    /**
     * This level model
     * @var \App\Level
     */
    private $level;

    /**
     * This building model
     * @var
     */
    private $building;

    /**
     * This building_level model
     * @var
     */
    private $buildingLevel;


    public function __construct(Level $levelModel, Building $buildingModel, Building_level $building_levelModel)
    {
        $this->level = $levelModel;

        $this->building = $buildingModel;

        $this->buildingLevel = $building_levelModel;
    }


    /**
     *Get all the levels available in the locate system
     * @return mixed
     */
    public function getAllLevels()
    {
        return $this->level->all();
    }

    /**
     * Get the name of a level in locate
     * @param $id
     * @return mixed
     */
    public function getLevelNameForBuilding($id)
    {
       return $this->buildingLevel->where('building_id', '=', $id)->get();
    }

    /**
     * Revive a building as possible to add levels
     * @param $request
     * @param $id
     */
    public function revive($request,$id)
    {
        $building = $this->building->findOrFail($id);

        $building->update([

            'numberOfLevels' => $request->howManyLevels
        ]);
    }
} 