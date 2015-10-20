<?php

namespace App\Http\Controllers\Clients;

use App\Http\Requests\Clients\DistributorRequest;
use App\Http\Controllers\Controller;
use App\Repos\DistributorRepository;
use Illuminate\Support\Facades\Session;

class DistributorController extends Controller
{
    /**
     * THis Distributor Repository
     * @var
     */
    private $repository;

    /**
     * This Distributor Request
     * @var
     */

    private $request;

    /**
     * The constructor initializer for this class
     * @param DistributorRepository $distributorRepository
     * @param DistributorRequest $distributorRequest
     */

    public function __construct(DistributorRepository $distributorRepository, DistributorRequest $distributorRequest)
    {
        $this->repository = $distributorRepository;

        $this->request = $distributorRequest;
    }

    /**
     * Register the authenticated user as a distributor
     * @return \Illuminate\View\View
     */

    public function registerDistributor()
    {
        $this->repository->register($this->request);

        $distributor = $this->repository->getDistributorDetails();

        Session::flash('flash_message','Your Distributors status was set!');

        return view('clients.distributor', compact('distributor'));
    }

    /**
     * Update the details of the authenticated distributor
     * @param id
     * @return \Illuminate\View\View
     */

    public function updateDistributor($id)
    {
        $this->repository->update($this->request, $id);

        Session::flash('flash_message','Distributor status was updated successfully');

        return redirect('client/distributor');
    }
}
