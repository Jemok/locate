<?php

namespace App\Http\Controllers\Levels;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;

use App\Repos\BuildingLevelsRepository;
use App\Repos\LevelsRepository;
use App\Repos\BuildingRepository;

class LevelsController extends Controller
{

    /**
     * This building level repository
     * @var \App\Repos\BuildingLevelsRepository
     */
    private $repo;

    /**
     * This levels repository
     * @var
     */
    private $levelsRepo;

    /**
     * This building repository
     * @var
     */
    private $building;

    /**
     * The constructor initializer for this class
     * @param BuildingLevelsRepository $buildingLevelsRepository
     * @param LevelsRepository $levelsRepository
     * @param BuildingRepository $buildingRepository
     */

    public function __construct(BuildingLevelsRepository $buildingLevelsRepository, LevelsRepository $levelsRepository, BuildingRepository $buildingRepository)
    {
        $this->repo = $buildingLevelsRepository;

        $this->levelsRepo = $levelsRepository;

        $this->building = $buildingRepository;
    }

    /**
     * Get the levels set up view
     * @param $id
     * @return \Illuminate\View\View
     */
    public function setUpLevel($id)
    {
        $levels = $this->levelsRepo->getAllLevels();

        $levelsCount = $this->building->getLevelsCount($id);

        $numberOfLevels = $this->building->getNumberOfLevels($id);

        $levelNames = $this->levelsRepo->getLevelNameForBuilding($id);

        return view('levels.set_up', compact('id', 'levels', 'levelsCount', 'numberOfLevels', 'levelNames'));
    }

    /**
     * Add a new level to a building
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addLevel(Request $request, $id)
    {
        $this->repo->persist($request, $id);

        Session::flash('flash_message', 'The level was set successfully!');

        return redirect('/building-level/set-up/'.$id);
    }

    /**
     * Opens up new levels if they had been closed
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function levelsRevive(Request $request, $id)
    {
        $this->levelsRepo->revive($request,$id);

        Session::flash('flash_message', 'The level was revived successfully!');

        return redirect('/building-level/set-up/'.$id);
    }
}

