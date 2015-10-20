<?php

namespace App\Http\Controllers\Street;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\StreetRepository;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Street\StreetRequest;

class StreetsController extends Controller
{

    /**
     * This street repository
     * @var
     */
    private $repo;

    /**
     * This street request
     * @var
     */
    private $request;

    /**
     * @param StreetRepository $streetRepository
     * @param StreetRequest $streetRequest
     */
    public function __construct(StreetRepository $streetRepository, StreetRequest $streetRequest)
    {
        $this->repo = $streetRepository;
        $this->request = $streetRequest;
    }

    /**
     * Adds a new street to the database
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createStreet()
    {
        $this->repo->persist($this->request);

        Session::flash('flash_message', 'The street was submitted successfully!');

        return redirect('/street/manage');
    }

    /**
     * Updates an agents single street
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateStreet($id)
    {
        $this->repo->updateStreet($this->request, $id);

        Session::flash('flash_message', 'The street details were updated successfully!');

        return redirect('/street/manage');
    }
}
