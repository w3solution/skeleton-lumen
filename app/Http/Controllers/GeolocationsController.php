<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Jcf\Geocode\Geocode;

use App\Models\Localization;
use Auth;


class GeolocationsController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function getAddressByLatLong(Request $request) {

        $user_geolocation = Localization::where(['user_id' => Auth::user()->id])->first();

        $response = Geocode::make()->latLng($user_geolocation->latitude, $user_geolocation->longitude);

        if ($response) {

            return [
                'latitude' => $response->latitude(),
                'longitude' => $response->longitude(),
                'Address' => $response->formattedAddress(),
                'Location type' =>  $response->locationType()
            ];

        }else{

            return response()->json(['status' => 'error', 'response' => 'user not found.']);

        }

    }
}
