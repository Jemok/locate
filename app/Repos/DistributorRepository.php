<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/4/15
 * Time: 1:03 PM
 */

namespace App\Repos;

use App\Distributor;


class DistributorRepository
{
    /**
     * The distributor model
     * @var \App\Distributor
     */

    private $distributor;

    /**
     * @param Distributor $distributorModel
     */

    public function __construct(Distributor $distributorModel)
    {

        $this->distributor = $distributorModel;

    }

    /**
     * Register the authenticated user as a distributor
     * @param $request
     */

    public function register($request)
    {

        \Auth::user()->distributor()->create([

            'distributorId' => $request->distributorId,
            'distributorName' => $request->distributorName,
        ]);
    }

    /**
     * Update the details of the authenticated distributor
     */
    public function update($request)
    {
        \Auth::user()->distributor()
             ->update([

                'distributorId' => $request->distributorId,
                'distributorName' => $request->distributorName,
            ]);
    }

    /**
     * Get the details of the authenticated distributor
     * @return mixed
     */

    public function getDistributorDetails()
    {
        return \Auth::user()->distributor()
                            ->first();
    }
} 