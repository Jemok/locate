<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/4/15
 * Time: 11:57 AM
 */

namespace App\Repos;

use App\Agent;


class AgentRepository {

    /**
     * @var \App\Agent
     */
    private $agent;

    /**
     * @param Agent $agentModel
     */

    public function __construct(Agent $agentModel)
    {
        $this->agent = $agentModel;
    }

    /**
     * Persist the agent to database
     * @param $request
     */

    public function register($request)
    {
        \Auth::user()->agent()->create([

            'businessNumber' => $request->businessNumber,
            'agentName' => $request->agentName,
            'agentEmail' => $request->agentEmail,
            'agentMobileNumber' => $request->agentMobileNumber,
            'openingHourWeekDay' => $request->openingHourWeekDay,
            'closingHourWeekDay' => $request->closingHourWeekDay,
            'openingHourSaturday' => $request->openingHourSaturday,
            'closingHourSaturday' => $request->closingHourWeekDay,
            'openingHourSunday'=> $request->openingHourSunday,
            'closingHourSunday'=> $request->openingHourSunday,

        ]);
    }

    /**
     * Update the agent details of the authenticated agent
     * @param $request
     * @param $id
     */

    public function update($request, $id)
    {
        \Auth::user()->agent()
                    ->where('id', '=', $id)
             ->update([

                'businessNumber' => $request->businessNumber,
                'agentName' => $request->agentName,
                'agentEmail' => $request->agentEmail,
                'agentMobileNumber' => $request->agentMobileNumber,
                'openingHourWeekDay' => $request->openingHourWeekDay,
                'closingHourWeekDay' => $request->closingHourWeekDay,
                'openingHourSaturday' => $request->openingHourSaturday,
                'closingHourSaturday' => $request->closingHourWeekDay,
                'openingHourSunday'=> $request->openingHourSunday,
                'closingHourSunday'=> $request->openingHourSunday,

            ]);
    }


    /**
     * Get the details of the logged in agent
     */

    public function getAgentDetails()
    {
        return \Auth::user()->agent()->first();
    }

    /**
     * Get an gents street count
     * @return mixed
     */
    public function getAgentStreetCount()
    {
        if(isset(\Auth::user()->streetCount))
        {
            return \Auth::user()->streetCount;
        }
        return 0;
    }
} 