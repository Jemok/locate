<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/12/15
 * Time: 6:16 PM
 */

namespace App\Repos;

use App\Parcel;

use App\Usage;

use App\Address;

use App\Track_ship;


class ParcelRepository
{
    /**
     * This parcel model
     * @var \App\Parcel
     */
    private $parcel;

    /**
     * The price of a sent parcel
     * @var
     */
    private $price;

    /**
     * The usage model
     * @var
     */
    private $usage;

    /**
     * @var
     */
    private $address;

    private $track_ship;

    /**
     * @param Parcel $parcelModel
     * @param Usage $usageModel
     * @param Address $addressModel
     * @param Track_ship $track_shipModel
     */
    public function __construct(Parcel $parcelModel, Usage $usageModel, Address $addressModel, Track_ship $track_shipModel)
    {
        $this->parcel = $parcelModel;

        $this->usage  = $usageModel;

        $this->address = $addressModel;

        $this->track_ship = $track_shipModel;
    }


    /**
     * Save a parcel to the database
     * @param $request
     */

    public function persist($request)
    {
        $this->setOtherParcelsAsOld();

        $parcel = \Auth::user()->parcel()->create([

            'parcelName'     => $request->parcelName,
            'parcelWeight'   => $request->parcelWeight,
            'parcelCategory' => $request->parcelCategory,

        ]);

        $this->setParcelStep($parcel);
    }

    /**
     * Sets the old previous parcel as not being actively worked on
     */
    private function setOtherParcelsAsOld()
    {
        $this->parcel
             ->where('parcelStatus', '=', 1)
             ->where('user_id', '=', \Auth::user()->id)
             ->update([

                'parcelStatus' => 0
            ]);
    }

    /**
     * Set the step of a new parcel to one
     * @param $parcel
     */
    private function setParcelStep($parcel)
    {
        $parcel->parcel_step()->create([

            'parcelStep' => 1

        ]);
    }

    /**
     * Get the currently being sent parcel
     * @return mixed
     */
    public function getParcelNew()
    {
        return $this->parcel->where('user_id', '=', \Auth::user()->id)
                            ->where('parcelStatus', '=', 1)->first();
    }

    /**
     * Update the details of a parcel
     * @param $request
     */
    public function updateParcelNew($request)
    {
        $parcel = $this->getParcelNew();

        $parcel->update([

            'parcelName'   => $request->parcelName,
            'parcelWeight' => $request->parcelWeight,
            'parcelCategory' => $request->parcelCategory
        ]);
    }

    /**
     * Saves the receiver of a parcel
     * @param $request
     */
    public function saveParcelReceiver($request)
    {
        $parcelNew = $this->getParcelNew();

        $parcelReceiver = $parcelNew->receiver()->create([

            'emailReceiver' => $emailReceiver = $request->emailReceiver,
            'user_id'       => \Auth::user()->id,
            'receiver_id'   => 0

        ]);

        $parcelReceiver->update([

           'receiver_id' => $this->getParcelReceiverIdFromEmail($parcelReceiver)
        ]);

        $this->updateParcelStepReceiver($parcelNew);
    }

    /**
     * Get the id of the parcel receiver from their email
     * @param $parcelReceiver
     * @return mixed
     */
    private function getParcelReceiverIdFromEmail($parcelReceiver)
    {
        $emailReceiver = $parcelReceiver
                        ->first()->emailReceiver;

        $receiver = \App\User::where('email', '=', $emailReceiver)->first();

        $receiver_id = $receiver->id;

        return $receiver_id;
    }

    /**
     * Get a list of all the sending parcels for the authenticated user
     * @return mixed
     */
    public function getUserParcelsPending()
    {
        return $this->parcel
                    ->where('user_id', '=', \Auth::user()->id)
                    ->where('parcelPendingStatus', '=',  0)
                    ->get();
    }

    /**
     * Gets the stage where a pending parcel was before being abandoned
     * @param $id
     * @return mixed
     */
    public function getParcelPendingStep($id)
    {
       $parcel = $this->parcel->findOrFail($id);

       return $parcel->parcel_step()->where('parcel_id', '=', $id)->first()->parcelStep;
    }

    /**
     * Updates the details of pending parcel
     * @param $request
     * @param $id
     */
    public function editDetailsPending($request, $id)
    {
        $parcel = $this->parcel->findOrFail($id);

        $parcel->update([

            'parcelName'   => $request->parcelName,
            'parcelWeight' => $request->parcelWeight,
            'parcelCategory' => $request->parcelCategory

        ]);
    }

    /**
     * Get the details of a pending parcel
     * @param $id
     * @return mixed
     */
    public function getParcelPendingDetails($id)
    {
        return $this->parcel->findOrFail($id);
    }

    /**
     * Persist a pending receiver to the database
     * @param $request
     * @param $parcelId
     */
    public function saveReceiverFinish($request , $parcelId)
    {
        $parcel = $this->parcel->findOrFail($parcelId);

        $parcel->receiver()->create([

            'emailReceiver' => $request->emailReceiver,
            'user_id'       => \Auth::user()->id
        ]);

        $this->updateParcelStepReceiver($parcel);
    }

    /**
     * Update the stage of a parcel being sent as having reached the receiver step
     * @param $parcel
     */
    public function updateParcelStepReceiver($parcel)
    {
        $parcel->parcel_step()->update([

            'parcelStep' => 2

        ]);
    }


    /**
     * Update the step of a parcel being sent as the delivery details having being set
     * @param $parcel
     */
    public function updateParcelStepDelivery($parcel)
    {
        $parcel->parcel_step()->update([

            'parcelStep' => 3

        ]);
    }

    /**
     * Get the receiver of a pending parcel
     * @param $id
     * @return mixed
     */
    public function getParcelPendingReceiver($id)
    {
        $parcel = $this->parcel->findOrFail($id);

        return $parcel->receiver()
                      ->where('parcel_id', '=', $id)
                      ->first();
    }

    /**
     * Update the receiver of a pending parcel
     * @param $request
     * @param $id
     */
    public function editReceiverPending($request, $id)
    {
        $parcel = $this->parcel->findOrFail($id);

        $parcel->receiver()
               ->where('parcel_id', '=', $id)
               ->update([

            'emailReceiver' => $request->emailReceiver

        ]);
    }

    /**
     * Save the delivery details of a pending parcel
     * @param $request
     * @param $parcelId
     */
    public function saveDeliveryFinish($request, $parcelId)
    {
        $parcel = $this->parcel->findOrFail($parcelId);

        $parcel->delivery()->create([

            'parcelDeliveryDate' => $request->parcelDeliveryDate
        ]);

        $this->updateParcelStepDelivery($parcel);
    }

    /**
     * Get the delivery details of a pending parcel
     * @param $parcelId
     * @return mixed
     */
    public function  getParcelPendingDelivery($parcelId)
    {
        $parcel = $this->parcel->findOrFail($parcelId);

        return $parcel->delivery()
            ->where('parcel_id', '=', $parcelId)
            ->first();
    }

    /**
     * Update the delivery details of a pending parcel
     * @param $request
     * @param $parcelId
     */
    public function editDeliveryPending($request ,$parcelId)
    {
        $parcel = $this->parcel->findOrFail($parcelId);

        $parcel->delivery()
            ->where('parcel_id', '=', $parcelId)
            ->update([

                'parcelDeliveryDate' => $request->parcelDeliveryDate

            ]);
    }

    /**
     * Get back the receiver of a new parcel
     * @return null
     */
    public function getBackReceiver()
    {
        if($parcel = $this->parcel
                       ->where('user_id', '=', \Auth::user()->id)
                       ->where('parcelStatus', '=', 1)
                       ->first()
          )
        {
           if($parcel_receiver = $parcel->with('receiver') == null)
           {
                if(isset($parcel_receiver))
                {
                    return $parcel->reciver->first;
                }
                else
                {
                    $parcelReceiver = null;

                    return $parcelReceiver;
                }
           }
            else
           {
                return $parcel->receiver()
                              ->where('parcel_id', '=', $parcel->id)
                              ->first();
           }
        }
        else
        {
            $parcelReceiver = null;

            return $parcelReceiver;
        }
    }

    /**
     * Update the receiver of a new parcel
     * @param $request
     */
    public function updateReceiverNew($request)
    {
        $receiver = $this->getBackReceiver();

        $receiver->update([

            'emailReceiver' => $request->emailReceiver
        ]);
    }

    /**
     * Save the delivery details of a new parcel
     * @param $request
     * @return string
     */
    public function saveDeliveryNew($request)
    {
        $parcel = $this->parcel
                       ->where('user_id', '=', \Auth::user()->id)
                       ->where('parcelStatus', '=', 1)
                       ->first();

        $delivery = $parcel->delivery()
               ->create([

                'parcelDeliveryDate' => $request->parcelDeliveryDate

            ]);

        $this->updateParcelStepDelivery($parcel);

        return $this->generateQuotation($delivery);
    }

    /**
     * Generate the quotation of a sent parcel
     * @param $delivery
     * @return string
     */
    private function generateQuotation($delivery)
    {
        $parcel = $delivery->parcel()
            ->where('id', '=', $delivery->parcel_id)
            ->first();

        $parcelWeight = $parcel->parcelWeight;

        if(($parcelWeight >= 1 && $parcelWeight <= 15))
        {
            $this->price = 100;
        }
        if($parcelWeight >15 && $parcelWeight <= 30)
        {
            $this->price = 200;
        }
        if($parcelWeight >30 )
        {
            $this->price = 300;
        }

        $this->saveQuotation($parcel, $this->price);

        return "Price of sending the parcel is : " .$this->price;

    }

    /**
     * Get back the delivery details of a new parcel
     * @return null
     */
    public function getBackDelivery()
    {
        if($parcel = $this->parcel
            ->where('user_id', '=', \Auth::user()->id)
            ->where('parcelStatus', '=', 1)
            ->first())
        {
            return $parcel->delivery()->first();
        }
        else
        {
            $parcelDelivery = null;

            return $parcelDelivery;
        }

    }

    /**
     * Update the delivery details of a new parcel
     * @param $request
     */
    public function updateDeliveryNew($request)
    {
        $delivery = $this->getBackDelivery();

        $delivery->update([

            'parcelDeliveryDate' => $request->parcelDeliveryDate
        ]);
    }

    /**
     * Send a new parcel
     */
    public function parcelSendNew()
    {
        $parcel = $this->parcel
                       ->where('user_id', '=', \Auth::user()->id)
                       ->where('parcelStatus', '=', 1)
                       ->where('parcelPendingStatus', '=', 0)
                       ->first();

        $parcel->update([

            'parcelPendingStatus' => 1
        ]);

    }

    /**
     * Get all the parcels sent by the authenticated user
     * @return mixed
     */
    public function getUserSentParcels()
    {
        return $this->parcel
            ->where('user_id', '=', \Auth::user()->id)
            ->where('parcelPendingStatus', '=',  1);
    }

    /**
     * Save a quotation of a sent parcel to the database
     */
    private function saveQuotation($parcel, $price)
    {
        $trackCode = $parcel->id;

        $parcel->quotation()
               ->create([

                'user_id' => \Auth::user()->id,
                'quotationPrice' => $price,
                'trackCode'  => $trackCode
            ]);

        $this->setTrackShip($parcel);
    }

    /**
     * Save the tracking details of a parcel to the database
     * @param $parcel
     */
    private function setTrackShip($parcel)
    {
        $parcel->track()
               ->create([

                'sender_id' => $sender_id = \Auth::user()->id,
                'sender_address' => $this->getSenderAddress($sender_id),
                'receiver_id' => $receiver_id = $this->getParcelReceiverId($parcel),
                'receiver_address' => $this->getReceiverAddress($receiver_id),
                'agent_sender' => $this->getSenderAgent(),
                'agent_receiver' => $this->getReceiverAgent($receiver_id),
                'ship_status'  => 1
            ]);
    }

    /**
     * Get the address of the citizen sending a parcel
     * @param $sender_id
     * @return mixed
     */
    private function getSenderAddress($sender_id)
    {
       $usage = $this->usage->where('user_id', '=', $sender_id)
                   ->where('usageActivity', '=', 1)->first();

       return $usage->address_id;
    }

    /**
     * Get the address of the receiver being sent a parcel
     * @param $receiver_id
     * @return mixed
     */
    private function getReceiverAddress($receiver_id)
    {
        $usage = $this->usage->where('user_id', '=', $receiver_id)
            ->where('usageActivity', '=', 1)->first();

        return $usage->address_id;
    }

    /**
     * Get the id of the citizen receiving a parcel
     * @param $parcel
     * @return mixed
     */
    private function getParcelReceiverId($parcel)
    {
        $emailReceiver = $parcel->receiver()
                ->first()->emailReceiver;

        $receiver = \Auth::user()->where('email', '=', $emailReceiver)->first();

        $receiver_id = $receiver->id;

        return $receiver_id;
    }

    /**
     * The the agent of the citizen sending a parcel
     * @return mixed
     */
    private function getSenderAgent()
    {
        $usage = $this->usage->where('user_id', '=', \Auth::user()->id)
                               ->where('usageActivity', '=', 1)
                               ->first();
        $address_id = $usage->address_id;

        $address = $this->address->findOrFail($address_id);

        $agent_id = $address->agent_id;

        return $agent_id;
    }

    /**
     * Get the receiver of a parcel
     * @param $receiver_id
     * @return mixed
     */
    private function getReceiverAgent($receiver_id)
    {
        $usage = $this->usage->where('user_id', '=', $receiver_id)
            ->where('usageActivity', '=', 1)
            ->first();
        $address_id = $usage->address_id;

        $address = $this->address->findOrFail($address_id);

        $agent_id = $address->agent_id;

        return $agent_id;
    }

    /**
     * Get all the parcels to be picked by an agent
     * @return mixed
     */
    public function getAgentToPickParcels()
    {
        return $this->track_ship->where('agent_sender', '=', \Auth::user()->id)
                                ->where('ship_status', '=', 1);
    }

    /**
     * Set a parcel as having being picked by an agent
     * @param $ship_id
     */
    public function setParcelPicked($ship_id)
    {
        $ship = $this->track_ship->findOrFail($ship_id);

        $ship->update([

            'ship_status' => 2
        ]);
    }

    /**
     * Get all the parcels picked by an agent
     * @return mixed
     */
    public function getAgentParcelsPicked()
    {
        return $this->track_ship->where('agent_sender', '=', \Auth::user()->id)
            ->where('ship_status', '=', 2);
    }

    /**
     * Get an agents incoming parcels
     * @return mixed
     */
    public function getAgentIncomingParcels()
    {
        return $this->track_ship->where('agent_receiver', '=', \Auth::user()->id)
            ->where('ship_status', '=', 3);
    }

    /**
     * Agent ships a parcel
     * @param $pick_id
     */
    public function shipParcel($pick_id)
    {
        $ship = $this->track_ship->findOrFail($pick_id);

        $ship->update([

            'ship_status' => 3
        ]);
    }

    /**
     * Get the parcels that have been shipped by an agent
     * @return mixed
     */
    public function getAgentParcelsShipped()
    {
        return $this->track_ship->where('agent_sender', '=', \Auth::user()->id)
            ->where('ship_status', '=', 3);
    }

    /**
     * A citizen tracks a parcel
     * @param $trackId
     * @return mixed
     */
    public function trackParcel($trackId)
    {
        return $this->track_ship->where('parcel_id', '=', $trackId)
                                ->first();
    }

    /**
     * Agent receive an incoming parcel
     * @param $incoming_id
     */
    public function receiveIncomingParcel($incoming_id)
    {
        $ship = $this->track_ship->findOrFail($incoming_id);

        $ship->update([

            'ship_status' => 4
        ]);
    }

    /**
     * Get the agents received by an agent
     * @return mixed
     */
    public function getAgentReceivedParcels()
    {
        return $this->track_ship->where('agent_receiver', '=', \Auth::user()->id)
            ->where('ship_status', '=', 4);
    }

    /**
     * Get the parcels that an agent shipped and were received by the other agent
     * @return mixed
     */
    public function getAgentReceivedParcelsByOther()
    {
        return $this->track_ship->where('agent_sender', '=', \Auth::user()->id)
            ->where('ship_status', '=', 4);
    }

    /**
     * Get all the parcels that have been delivered to citizens by agents
     * @return mixed
     */
    public function getAgentDeliveredParcels()
    {
        return $this->track_ship->where('agent_receiver', '=', \Auth::user()->id)
            ->where('ship_status', '=', 5);
    }

    /**
     * Get all the incoming parcels of a citizen
     * @return mixed
     */
    public function getUserIncomingParcels()
    {
        return $this->track_ship->where('receiver_id', '=', \Auth::user()->id)
            ->where('ship_status', '<', 5);
    }

    /**
     * A citizen sets a delivered parcel
     * @param $parcel_id
     */
    public function setParcelAsDelivered($parcel_id)
    {
        $ship = $this->track_ship->findOrFail($parcel_id);

        $ship->update([

            'ship_status' => 5
        ]);
    }

    /**
     * Get all the parcels that have been delivered to a citizen
     * @return mixed
     */
    public function getUserDeliveredParcels()
    {
        return $this->track_ship->where('receiver_id', '=', \Auth::user()->id)
            ->where('ship_status', '=', 5);
    }

    /**
     * Get the parcels that an agent sent to another agent and were delivered successfully
     * @return mixed
     */
    public function getAgentDeliveredParcelsByOther()
    {
        return $this->track_ship->where('agent_sender', '=', \Auth::user()->id)
            ->where('ship_status', '=', 5);
    }

    /**
     * Get a citizens delivered parcels..
     * @return mixed
     */
    public function getYourDeliveredParcels()
    {
        return $this->track_ship->where('receiver_id', '=', \Auth::user()->id)
            ->where('ship_status', '=', 5);
    }
} 