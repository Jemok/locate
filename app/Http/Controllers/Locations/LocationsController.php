<?php

namespace App\Http\Controllers\Locations;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repos\LocationsRepository;
use App\Repos\BuildingLevelsRepository;


class LocationsController extends Controller
{
    /**
     * This locations repository
     * @var \App\Repos\LocationsRepository
     */
    private $repo;

    /**
     * This building level repository
     * @var \App\Repos\BuildingLevelsRepository
     */
    private $buildingLevel;

    /**
     * The constructor initializer for this class
     * @param LocationsRepository $locationsRepository
     * @param BuildingLevelsRepository $buildingLevelsRepository
     */
    public function __construct(LocationsRepository $locationsRepository, BuildingLevelsRepository $buildingLevelsRepository)
    {
        $this->repo = $locationsRepository;

        $this->buildingLevel = $buildingLevelsRepository;
    }

    /**
     * Gets the locations set up view
     * @param $id
     * @return \Illuminate\View\View
     */
    public function setUpLocation($id)
    {
        return view('locations.set_up', compact('id'));
    }

    /**
     * Registers a new location in the database
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function register(Request $request, $id)
    {
        $this->repo->persist($request, $id);

        return redirect('/location/address/'.$id);
    }

    /**
     * Gets all the locations that belong to alocation
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getLevelsLocations($id)
    {
       $locations = $this->repo->getLocations($id);

       return view('locations.manage', compact('locations'));
    }
}
