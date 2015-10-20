<?php

namespace App\Http\Controllers\Pages;

use App\Repos\BuildingRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repos\CitizenRepository;
use App\Repos\AgentRepository;
use App\Repos\DistributorRepository;
use App\Repos\StreetRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Repos\AddressRepository;

use App\Repos\ParcelRepository;

class PagesController extends Controller
{
    /**
     * The citizen repository
     * @var \App\Repos\CitizenRepository
     */
    private $citizen;

    /**
     * The agent repository
     * @var
     */
    private $agent;

    /**
     * The distributor repository
     * @var \App\Repos\AgentRepository
     */

    private $distributor;

    /**
     * The street repository
     * @var
     */
    private $street;

    /**
     * This building repository
     * @var
     */
    private $building;

    /**
     * This address repository
     * @var
     */
    private $address;

    private $parcel;

    /**
     * @param ParcelRepository $parcelRepository
     * @param $citizenRepository
     * @param AgentRepository $agentRepository
     * @param DistributorRepository $distributorRepository
     * @param StreetRepository $streetRepository
     * @param BuildingRepository $buildingRepository
     * @param AddressRepository $addressRepository
     */
    public function __construct(ParcelRepository $parcelRepository, CitizenRepository $citizenRepository, AgentRepository $agentRepository, DistributorRepository $distributorRepository, StreetRepository $streetRepository, BuildingRepository $buildingRepository, AddressRepository $addressRepository)
    {
       $this->citizen = $citizenRepository;

       $this->agent = $agentRepository;

       $this->distributor = $distributorRepository;

       $this->street = $streetRepository;

       $this->building= $buildingRepository;

       $this->address = $addressRepository;

       $this->parcel = $parcelRepository;
    }
    /**
     * get client-citizen
     *
     */

    public function getCitizen()
    {
        $citizen = $this->citizen->getCitizenDetails();

        $uses = $this->citizen->getCitizenAddresses();

        $parcelsPending = $this->parcel->getUserParcelsPending();

        $sentParcels = $this->parcel->getUserSentParcels();

        $incomingParcels = $this->parcel->getUserIncomingParcels();

        $deliveredParcels = $this->parcel->getUserDeliveredParcels();

        $deliveredParcelsByYou = $this->parcel->getYourDeliveredParcels();

        //dd($incomingParcels);

        return view('clients.citizen', compact('deliveredParcelsByYou','deliveredParcels','incomingParcels','citizen', 'uses', 'parcelsPending', 'sentParcels'));
    }

    /**
     * get client-agent
     *
     */

    public function getAgent()
    {
        $agent = $this->agent->getAgentDetails();
        $streetCount = $this->agent->getAgentStreetCount();
        $parcelsToPick = $this->parcel->getAgentToPickParcels();
        $parcelsPicked = $this->parcel->getAgentParcelsPicked();
        $parcelsOnTransit = $this->parcel->getAgentParcelsShipped();
        $parcelsIncoming = $this->parcel->getAgentIncomingParcels();
        $parcelsReceived = $this->parcel->getAgentReceivedParcels();
        $parcelsReceivedOther = $this->parcel->getAgentReceivedParcelsByOther();
        $parcelsDeliveredOther = $this->parcel->getAgentDeliveredParcelsByOther();

        $parcelsDeliveredToCitizen = $this->parcel->getAgentDeliveredParcels();



        return view('clients.agent', compact('parcelsDeliveredToCitizen','parcelsDeliveredOther','parcelsReceivedOther','parcelsReceived','agent', 'streetCount', 'parcelsToPick', 'parcelsPicked', 'parcelsOnTransit', 'parcelsIncoming'));
    }


    /** get client-distributor
     *
     */

    public function getDistributor()
    {
        $distributor = $this->distributor->getDistributorDetails();

        return view('clients.distributor', compact('distributor'));
    }

    /**
     * Get the manage streets view
     * @return \Illuminate\View\View
     */

    public function manageStreet()
    {
        $streets = $this->street->getAgentStreets();

        return view('streets.manage', compact('streets'));
    }

    /**
     * Add a new street
     * @return \Illuminate\View\View
     */

    public function addStreet()
    {
        return view('streets.add_street');
    }

    public function editStreet($id)
    {
        $street = $this->street->getSingleStreet($id);

        return view('streets.edit', compact('street'));
    }

    /**
     * Get the set up building page
     * @param $id
     * @return \Illuminate\View\View
     */
    public function setUpBuilding($id)
    {
        return view('buildings.set_up', compact('id'));
    }

    /**
     * Returns the edit building page
     * @param $id
     * @return \Illuminate\View\View
     */
    public function editBuilding($id)
    {
        $building = $this->building->getBuildingDetails($id);

        return view('buildings.edit', compact('building','id'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateBuilding(Request $request, $id)
    {
        $this->building->update($request, $id);

        $id = $this->building->getStreetBuilding($id);

        Session::flash('flash_message', 'Building was updated successfully!');

        return redirect('/street/buildings/'.$id);
    }


    /**
     * Delete a building
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteBuilding($id)
    {
        $street_id = $this->building->getStreetBuilding($id);

        $this->building->delete($id);

        Session::flash('flash_message', 'Building was Deleted Successfully!');

        return redirect('/street/buildings/'.$street_id);
    }

    /**
     * Search for an agent
     * @return \Illuminate\View\View
     */
    public function search()
    {
        $results = \App\Agent::where('agentName', '=', $_POST['search'])->first();

        $agent_id = $results->user_id;

        $addresses = \App\Address::where('agent_id', '=', $agent_id);

        return view('address.manage', compact('results', 'addresses', 'usage'));
    }

    /**
     * Get the send parcel view
     * @return \Illuminate\View\View
     */
    public function getSendParcel()
    {
        return view('parcel.send');
    }

    /**
     * Get the send parcel receiver view
     * @return \Illuminate\View\View
     */
    public function getSendParcelReceiver()
    {
        return view('parcel.receiver');
    }

    /**
     * Get the parcel delivery view
     * @return \Illuminate\View\View
     */
    public function getSendDelivery()
    {
       return view('parcel.delivery');
    }

    /**
     * Get the send parcel quotation view
     * @return \Illuminate\View\View
     */
    public function getSendParcelQuotation()
    {
        return view('parcel.quotation');
    }


}
