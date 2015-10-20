<?php

namespace App\Http\Controllers\Buildings;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\BuildingRepository;
use App\Http\Requests\Building\BuildingRequest;
use Illuminate\Support\Facades\Session;

class BuildController extends Controller
{
    /**
     * This building repository
     * @var \App\Repos\BuildingRepository
     */
    private $building;

    /**
     * This request
     * @var
     */

    private $request;

    /**
     * This constructor initializer
     * @param BuildingRepository $buildingRepository
     */
    public function __construct(BuildingRepository $buildingRepository, BuildingRequest $buildingRequest)
    {
        $this->building= $buildingRepository;

        $this->request = $buildingRequest;
    }

    /**
     * Register a new building to db
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function registerBuilding($id)
    {
        $this->building->persist($this->request, $id);

        Session::flash('flash_message', 'Building was created successfully!');

        return redirect('street/manage');
    }
}
