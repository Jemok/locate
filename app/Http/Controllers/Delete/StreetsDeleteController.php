<?php

namespace App\Http\Controllers\Delete;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\StreetRepository;
use Illuminate\Support\Facades\Session;

class StreetsDeleteController extends Controller
{
    /**
     * This street repository
     * @var
     */
    private $street;

    public function __construct(StreetRepository $streetRepository)
    {
        $this->street = $streetRepository;
    }
    /**
     * Removes a street form the database
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteStreet($id)
    {
        $this->street->delete($id);

        Session::flash('flash_message', 'The street was deleted successfully!');

        return redirect('/street/manage/');
    }

    /**
     * Close a street
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function closeStreet($id)
    {
        $this->street->close($id);

        return redirect('street/manage');
    }

    /**
     * Open up a closed street
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function openStreet($id)
    {
        $this->street->open($id);

        return redirect('street/manage');
    }

    /**
     * Get all the buildings that belong to a particular street
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getStreetBuildings($id)
    {
        $buildings = $this->street->buildings($id);

        $streetName = $this->street->getStreetName($id);

        return view('streets.buildings', compact('buildings', 'streetName'));
    }
}
