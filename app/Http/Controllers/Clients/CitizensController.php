<?php

namespace App\Http\Controllers\Clients;

use App\Http\Requests\Clients\CitizenRequest;
use App\Http\Controllers\Controller;
use App\Repos\CitizenRepository;
use Illuminate\Support\Facades\Session;

class CitizensController extends Controller
{
    /**
     * The citizen repository
     * @var
     */
    private $citizen;

    /**
     * The citizen request
     * @var
     */

    private $request;

    /**
     * The constructor initializer for this class
     * @param CitizenRepository $citizenRepo
     * @param CitizenRequest $citizenRequest
     */

    public function __construct(CitizenRepository $citizenRepo, CitizenRequest $citizenRequest)
    {
        $this->citizen = $citizenRepo;

        $this->request = $citizenRequest;
    }

    /**
     * Register a user as new citizen
     */
    public function registerCitizen()
    {
       $this->citizen->register($this->request);

       Session::flash('flash_message', 'Your citizen status was created!');

       return redirect('/client/citizen');
    }

    /**
     * Update the citizen details of the logged in user
     * @return \Illuminate\View\View
     * @param $id
     */

    public function updateCitizen($id)
    {
       $this->citizen->update($this->request, $id);

       Session::flash('flash_message', 'Citizen status was updated!');

       return redirect('/client/citizen');
    }
}
