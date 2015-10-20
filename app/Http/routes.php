<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', function () {
    return view('welcome');
});

Route::get('/protected-resource', ['middleware' => 'oauth', function() {

    $usage = \App\Usage::where('user_id', '=', \Auth::user()->id)
                         ->where('usageActivity', '=', 1)  ->first()->address_id;

    $address = \App\Address::where('id', '=', $usage)->first()->address;

    //return Response::json(['address' => $address]);

    //return redirect()->route('shelves', ['address' => $address]);


    return Redirect::to('http://localhost:34000/locate/import?address='.$address);


}]);

Route::get('/shelves', ['as' => 'shelves'], function(){

    return redirect('http://localhost:34000/cart/cart');

});


Route::get('oauth/authorize', ['as' => 'oauth.authorize.get','middleware' => ['check-authorization-params', 'auth'], function() {
    // display a form where the user can authorize the client to access it's data
    $authParams = Authorizer::getAuthCodeRequestParams();
    $formParams = array_except($authParams,'client');
    $formParams['client_id'] = $authParams['client']->getId();



    return View::make('oauth.authorization_form', ['params'=>$formParams,'client'=>$authParams['client']]);

}]);


Route::post('oauth/authorize', ['as' => 'oauth.authorize.post','middleware' => ['csrf', 'check-authorization-params', 'auth'], function() {

    $params = Authorizer::getAuthCodeRequestParams();
    $params['user_id'] = \Auth::user()->id;
    $redirectUri = '';

    // if the user has allowed the client to access its data, redirect back to the client with an auth code
    if (Input::get('approve') !== null) {
        $redirectUri = Authorizer::issueAuthCode('user', $params['user_id'], $params);

        //dd($redirectUri);

        $string = array();

        $string = str_split($redirectUri, 29);

        $code = $string[1].$string[2];




        if($redirectUri == true)
        {
            $redirectUri = 'oauth/access_token?grant_type=authorization_code&client_id=1&client_secret=shelves&redirect_uri=http://localhost:34000/&code='.$code;


        }
    }

    // if the user has denied the client to access its data, redirect back to the client with an error message
    if (Input::get('deny') !== null) {
        $redirectUri = Authorizer::authCodeRequestDeniedRedirectUri();
    }
    return Redirect::to($redirectUri);
}]);



Route::get('oauth/access_token', function() {

    $access_token[] = Authorizer::issueAccessToken();

    //dd($access_token);

    return redirect('/protected-resource?access_token='.$access_token[0]['access_token']);

});

Route::get('/auth/login', function(){

    if(Auth::loginUsingId(1))
    {
      return 'A user is logged in';
    }
    else
    {
        return 'No user is logged in ';
    }


});

Route::get('/home', function(){

    return view('home');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//User-clients routes
Route::get('client/citizen', 'Pages\PagesController@getCitizen');
Route::get('client/agent', 'Pages\PagesController@getAgent');
Route::get('client/distributor', 'Pages\PagesController@getDistributor');

//Client-citizen routes
Route::post('/citizen/register', 'Clients\CitizensController@registerCitizen');
Route::patch('/citizen/update/{id}', 'Clients\CitizensController@updateCitizen');



//Client-agent routes
Route::post('/agent/register', 'Clients\AgentsController@registerAgent');
Route::patch('/agent/update/{id}', 'Clients\AgentsController@updateAgent');
Route::post('/agent/search/', 'Pages\PagesController@search');

//Client-distributor routes
Route::post('/distributor/register', 'Clients\DistributorController@registerDistributor');
Route::patch('/distributor/update/{id}', 'Clients\DistributorController@updateDistributor');

//Manage locations routes
Route::get('/location/manage/', 'Pages\PagesController@manageLocations');

//Manage street routes
Route::get('/street/manage/', 'Pages\PagesController@manageStreet');
Route::get('/street/edit/{id}/', 'Pages\PagesController@editStreet');
Route::get('/street/add/', 'Pages\PagesController@addStreet');
Route::post('/street/register/', 'Street\StreetsController@createStreet');
Route::get('/street/delete/{id}/', 'Delete\StreetsDeleteController@deleteStreet');
Route::patch('/street/update/{id}/', 'Street\StreetsController@updateStreet');
Route::get('/street/buildings/{id}/', 'Delete\StreetsDeleteController@getStreetBuildings');

//Street - buildings routes
Route::get('/street-building/set-up/{id}', 'Pages\PagesController@setUpBuilding');
Route::post('/street-building/register/{id}', 'Buildings\BuildController@registerBuilding');
Route::get('/street-building/close/{id}', 'Delete\StreetsDeleteController@closeStreet');
Route::post('/street-building/open/{id}', 'Delete\StreetsDeleteController@openStreet');

//Buildings routes
Route::get('/building/edit/{id}', 'Pages\PagesController@editBuilding');
Route::patch('/building/update/{id}', 'Pages\PagesController@updateBuilding');
Route::get('/building/delete/{id}', 'Pages\PagesController@deleteBuilding');

//Building - levels routes
Route::get('/building-level/set-up/{id}', 'Levels\LevelsController@setUpLevel');
Route::post('/building-level/register/{id}', 'Levels\LevelsController@addLevel');
Route::post('/building-level/revive/{id}', 'Levels\LevelsController@levelsRevive');

//Locations route
Route::get('/location/set-up/{id}', 'Locations\LocationsController@setUpLocation');
Route::post('/location/register/{id}', 'Locations\LocationsController@register');
Route::get('/location/address/{id}', 'Locations\LocationsController@getLevelsLocations');

//Address routes
Route::get('/address/manage', 'Address\AddressController@manageAddress');
Route::get('/address/use/{address_id}/{user_id}', 'Address\AddressController@useAddress');
Route::get('/address/un-use/{address_id}/{user_id}', 'Address\AddressController@unUseAddress');
Route::get('/address/usage-activate/{usage_id}', 'Address\AddressController@setUsageActivity');

//Parcels routes:
Route::get('/parcel/send/', 'Pages\PagesController@getSendParcel');
Route::post('/parcel/send/', 'Parcel\ParcelController@saveParcel');
Route::post('/parcel/send-update/', 'Parcel\ParcelController@updateParcelNew');
Route::get('/parcel/receiver/', 'Pages\PagesController@getSendParcelReceiver');
Route::post('/parcel/receiver/', 'Parcel\ParcelController@setReceiverNew');
Route::get('/parcel/pick-up/', 'Pages\PagesController@getSendDelivery');
Route::get('/parcel/quotation/', 'Pages\PagesController@getSendParcelQuotation');
Route::get('/receiver/back/', 'Parcel\ParcelController@getBackSendParcel');
Route::get('/parcel/continue/{id}/', 'Parcel\ParcelController@continuePendingParcel');
Route::get('/continue/details/edit/{id}', 'Parcel\ParcelController@continueEditDetails');
Route::post('/parcel/details-edit-update/{id}', 'Parcel\ParcelController@editDetailsPending');
Route::get('/parcel/receiver-finish/{parcelId}', 'Parcel\ParcelController@receiverFinish');
Route::post('/parcel/receiver-finish/{parcelId}', 'Parcel\ParcelController@saveReceiverFinish');
Route::get('/continue/receiver/edit/{id}', 'Parcel\ParcelController@continueEditReceiver');
Route::post('/parcel/receiver-edit-update/{id}', 'Parcel\ParcelController@editReceiverPending');
Route::get('/parcel/delivery-finish/{parcelId}', 'Parcel\ParcelController@deliveryFinish');
Route::post('/parcel/delivery-finish/{parcelId}', 'Parcel\ParcelController@saveDeliveryFinish');
Route::get('/continue/delivery/edit/{id}', 'Parcel\ParcelController@continueEditDelivery');
Route::post('/parcel/delivery-edit-update/{id}', 'Parcel\ParcelController@editDeliveryPending');
Route::get('/delivery/back/', 'Parcel\ParcelController@getBackReceiver');
Route::post('/parcel/receiver-update/', 'Parcel\ParcelController@updateReceiverNew');
Route::post('/parcel/delivery/', 'Parcel\ParcelController@setDeliveryNew');
Route::get('/quotation/back/', 'Parcel\ParcelController@getBackDelivery');
Route::post('/parcel/delivery-update/', 'Parcel\ParcelController@updateDeliveryNew');
Route::get('/parcel/send-new/', 'Parcel\ParcelController@parcelSendNew');
Route::get('/parcel/pick/{ship_id}', 'Parcel\ParcelController@setParcelPicked');
Route::get('/parcel/ship/{pick_id}', 'Parcel\ParcelController@shipParcel');
Route::get('/parcel/track/{track_id}', 'Parcel\ParcelController@trackParcel');
Route::get('/parcel/track/', 'Parcel\ParcelController@trackParcelFromHome');
Route::get('/parcel/incoming/{incoming_id}', 'Parcel\ParcelController@receiveIncomingParcel');
Route::get('/parcel/set-delivered/{parcel_id}', 'Parcel\ParcelController@setParcelAsDelivered');





















