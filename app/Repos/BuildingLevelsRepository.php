<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/10/15
 * Time: 11:08 AM
 */

namespace App\Repos;

use App\Building_level;
use App\Building;
use App\Level;


class BuildingLevelsRepository {

    /**
     * This building_level model
     * @var \App\Building_level
     */
    private $building_level;

    /**
     * This building model
     * @var \App\Building
     */
    private $building;

    /**
     * This level model
     * @var \App\Level
     */
    private $level;

    /**
     * This constructor initializer
     * @param Building_level $building_levelModel
     * @param Building $buildingModel
     * @param Level $levelModel
     */
    public function __construct(Building_level $building_levelModel, Building $buildingModel, Level $levelModel)
    {
        $this->building_level = $building_levelModel;

        $this->building = $buildingModel;

        $this->level = $levelModel;
    }

    /**
     * Persist a building level to the database
     * @param $request
     * @param $id
     */
    public function persist($request, $id)
    {
        $building = $this->building->findOrFail($id);

        $building->levels()->create([

            'building_id' => $id,
            'level_id'    => $request->levelName,
            'levelName'   => $this->level->where('id', '=', $request->levelName)->first()->levelName
         ]);

        $this->updateLevels($building);
    }

    /**
     * Decrease the number of levels in a building by one
     * @param $building
     */
    private function updateLevels($building)
    {
        $building->update([
            'numberOfLevels' => ($building->numberOfLevels) - 1,
        ]);
    }

} 