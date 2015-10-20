<?php

namespace App\Http\Controllers\Clients;

use App\Http\Requests\Clients\AgentRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\AgentRepository;
use Illuminate\Support\Facades\Session;

class AgentsController extends Controller
{
    /**
     * This agent request
     * @var \App\Http\Requests\Clients\AgentRequest
     */
    private $request;

    /**
     * This agent repository
     * @var \App\Repos\AgentRepository
     */
    private $repository;

    /**
     * The constructor initializer for this class
     * @param AgentRequest $agentRequest
     * @param AgentRepository $agentRepository
     *
     */

    public function __construct(AgentRequest $agentRequest, AgentRepository $agentRepository)
    {
        $this->request = $agentRequest;

        $this->repository = $agentRepository;
    }

    /**
     * Register a user as an agent
     * @return \Illuminate\View\View
     */

    public function registerAgent()
    {
        $this->repository->register($this->request);

        Session::flash('flash_message', 'Your Agent status was created!');

        return redirect('/client/agent/');
    }

    /**
     * Update the Authenticated agent details
     * @return \Illuminate\View\View
     * @param $id
     */

    public function updateAgent($id)
    {
        $this->repository->update($this->request, $id);

        Session::flash('flash_message', 'Agent status was updated!');

        return redirect('client/agent');
    }

}
