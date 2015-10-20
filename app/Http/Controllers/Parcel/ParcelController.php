<?php

/**
 * Responsible for all the parcel processes
 * The parcel controller
 * @author James Mwangi
 */

namespace App\Http\Controllers\Parcel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\ParcelRepository;
use App\Http\Requests\ParcelRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ParcelReceiverRequest;
use App\Http\Requests\ParcelDeliveryRequest;

class ParcelController extends Controller
{
    /**
     * This parcel repository
     * @var
     */
    private $parcel;

    /**
     * This class constructor initializer
     * @param ParcelRepository $parcelRepository
     */
    public function __construct(ParcelRepository $parcelRepository)
    {
        $this->parcel = $parcelRepository;
    }

    /**
     * Persist a new parcel to the database
     * @param ParcelRequest $parcelRequest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveParcel(ParcelRequest $parcelRequest)
    {
        $this->parcel->persist($parcelRequest);

        Session::flash('flash_message', 'Your parcel was saved for sending!');

        return redirect('/parcel/receiver');
    }

    /**
     * Return back the parcel being sent to allow for editing
     * @return \Illuminate\View\View
     */
    public function getBackSendParcel()
    {
         $parcel = $this->parcel->getParcelNew();

         return view('parcel.send', compact('parcel'));
    }

    /**
     * Updates the details of a new parcel
     * @param ParcelRequest $parcelRequest
     * @return \Illuminate\View\View
     */
    public function updateParcelNew(ParcelRequest $parcelRequest)
    {
        $this->parcel->updateParcelNew($parcelRequest);

        return redirect('/delivery/back/');
    }

    /**
     * Set a parcel receivers email
     * @param ParcelReceiverRequest $parcelReceiverRequest
     * @return \Illuminate\View\View
     */
    public function setReceiverNew(ParcelReceiverRequest $parcelReceiverRequest)
    {
        $this->parcel->saveParcelReceiver($parcelReceiverRequest);

        return view('parcel.delivery');
    }

    /**
     * Return all the details of a pending parcel
     * @param $id
     * @return \Illuminate\View\View
     */
    public function continuePendingParcel($id)
    {
        $parcelStep = $this->parcel->getParcelPendingStep($id);

        $parcelId = $id;

        return view('parcel.pending', compact('parcelStep', 'parcelId'));
    }

    /**
     * Get the form for continue editing the parcel details of a pending parcel
     * @param $id
     * @return \Illuminate\View\View
     */
    public function continueEditDetails($id)
    {
        $parcel = $this->parcel->getParcelPendingDetails($id);

        $parcelId = $id;

        return view('parcel.details_finish', compact('parcel', 'parcelId'));
    }

    /**
     * Update the parcel details of a pending parcel in the database
     * @param ParcelRequest $parcelRequest
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editDetailsPending(ParcelRequest $parcelRequest, $id)
    {
        $this->parcel->editDetailsPending($parcelRequest, $id);

        return redirect('/parcel/continue/'. $id);
    }

    /**
     * Get the view for finishing the receiver email of a pending parcel
     * @param $parcelId
     * @return \Illuminate\View\View
     */
    public function receiverFinish($parcelId)
    {
        return view('parcel.receiver_finish', compact('parcelId'));
    }

    /**
     * Persist the the finished pending parcel receiver to the database
     * @param ParcelReceiverRequest $parcelReceiverRequest
     * @param $parcelId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveReceiverFinish(ParcelReceiverRequest $parcelReceiverRequest, $parcelId)
    {
        $this->parcel->saveReceiverFinish($parcelReceiverRequest, $parcelId);

        return redirect('/parcel/continue/'. $parcelId);
    }

    /**
     * Allow for a finished receiver of a pending parcel to be edited
     * @param $id
     * @return \Illuminate\View\View
     */
    public function continueEditReceiver($id)
    {
        $receiver = $this->parcel->getParcelPendingReceiver($id);

        $parcelId = $id;

        return view('parcel.receiver_finish', compact('receiver', 'parcelId'));
    }

    /**
     * Update the receiver of a pending parcel
     * @param ParcelReceiverRequest $parcelReceiverRequest
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editReceiverPending(ParcelReceiverRequest $parcelReceiverRequest,$id)
    {
        $this->parcel->editReceiverPending($parcelReceiverRequest ,$id);

        return redirect('/parcel/continue/'. $id);
    }

    /**
     * Get the view for finishing the delivery details of a pending parcel
     * @param $parcelId
     * @return \Illuminate\View\View
     */
    public function deliveryFinish($parcelId)
    {
        return view('parcel.delivery_finish', compact('parcelId'));
    }

    /**
     * Persist the delivery details finish of a pending parcel to the database
     * @param ParcelDeliveryRequest $parcelDeliveryRequest
     * @param $parcelId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveDeliveryFinish(ParcelDeliveryRequest $parcelDeliveryRequest ,$parcelId)
    {
        $this->parcel->saveDeliveryFinish($parcelDeliveryRequest ,$parcelId);

        return redirect('/parcel/continue/'.$parcelId);
    }

    /**
     * Edit the delivery details of a finished delivery pending parcel
     * @param $parcelId
     * @return \Illuminate\View\View
     */
    public function continueEditDelivery($parcelId)
    {
      $delivery = $this->parcel->getParcelPendingDelivery($parcelId);

      return view('parcel.delivery_finish', compact('delivery', 'parcelId'));
    }

    /**
     * Edit the finished delivery details of a pending parcel
     * @param ParcelDeliveryRequest $parcelDeliveryRequest
     * @param $parcelId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editDeliveryPending(ParcelDeliveryRequest $parcelDeliveryRequest ,$parcelId)
    {
        $this->parcel->editDeliveryPending($parcelDeliveryRequest ,$parcelId);

        return redirect('/parcel/continue/'. $parcelId);
    }

    /**
     * Get back the receiver of a parcel being sent real time
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getBackReceiver()
    {
        $receiver = $this->parcel->getBackReceiver();

        if($receiver == null)
        {
            return redirect('/parcel/receiver/');
        }

        return view('parcel.receiver', compact('receiver'));
    }

    /**
     * Update the receiver details of a new parcel
     * @param ParcelReceiverRequest $parcelReceiverRequest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateReceiverNew(ParcelReceiverRequest $parcelReceiverRequest)
    {
        $this->parcel->updateReceiverNew($parcelReceiverRequest);

        return redirect('/quotation/back/');
    }

    /**
     * Save the delivery details of a new parcel to the database
     * @param ParcelDeliveryRequest $parcelDeliveryRequest
     * @return \Illuminate\View\View
     */
    public function setDeliveryNew(ParcelDeliveryRequest $parcelDeliveryRequest)
    {
        $quotation = $this->parcel->saveDeliveryNew($parcelDeliveryRequest);

        return view('parcel.quotation', compact('quotation'));
    }

    /**
     * Get back the delivery details of a new parcel for editing
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getBackDelivery()
    {
        $delivery = $this->parcel->getBackDelivery();

        if($delivery == null)
        {
            return redirect('/parcel/pick-up');
        }

        return view('parcel.delivery', compact('delivery'));
    }

    /**
     * Update the delivery details of a new parcel being sent
     * @param ParcelDeliveryRequest $parcelDeliveryRequest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateDeliveryNew(ParcelDeliveryRequest $parcelDeliveryRequest)
    {
        $this->parcel->updateDeliveryNew($parcelDeliveryRequest);

        return redirect('/parcel/quotation/');
    }

    /**
     * Get the view for sending a new parcel
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function parcelSendNew()
    {
        $this->parcel->parcelSendNew();

        return redirect('/client/citizen/');
    }

    /**
     * Set a parcel as having being picked by an agent
     * @param $ship_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setParcelPicked($ship_id)
    {
        $this->parcel->setParcelPicked($ship_id);

        return redirect('/client/agent/');
    }

    /**
     * Agent ship a parcel method
     * @param $pick_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function shipParcel($pick_id)
    {
        $this->parcel->shipParcel($pick_id);

        return redirect('/client/agent/');
    }

    /**
     * The track a sent parcel method
     * @param $trackId
     * @return \Illuminate\View\View
     */
    public function trackParcel($trackId)
    {
        $trackDetails = $this->parcel->trackParcel($trackId);

        return view('parcel.track', compact('trackDetails'));
    }

    /**
     * Track a parcel without login in into locate . com
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function trackParcelFromHome(Request $request)
    {
        $trackDetails = $this->parcel->trackParcel($request->search);

        return view('welcome', compact('trackDetails'));
    }

    /**
     * Agent receive an incoming parcel method
     * @param $incoming_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function receiveIncomingParcel($incoming_id)
    {
        $this->parcel->receiveIncomingParcel($incoming_id);

        return redirect('/client/agent/');
    }

    /**
     * Citizen set a parcel as having being delivered to them
     * @param $parcel_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setParcelAsDelivered($parcel_id)
    {
        $this->parcel->setParcelAsDelivered($parcel_id);

        return redirect('/client/citizen/');
    }

}
