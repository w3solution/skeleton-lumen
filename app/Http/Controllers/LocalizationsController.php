<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localization;
use Auth;

class LocalizationsController extends Controller {

    public function __construct() {

        $this->middleware('auth');

    }

    public function index(Request $request) {

        $localization = Auth::user()->localization()->get();

        return response()->json([
            'status' => 'success',
            'result' => $localization
        ]);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->validate($request, [
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // no duplicated
        $user_geolocation = Localization::where(['user_id' => Auth::user()->id])->first();

        if(!empty($user_geolocation)) {

            return response()->json(['status' => 'error', 'response' => 'your location has already been recorded.']);
            
        }

        if(Auth::user()->localization()->create($request->all())){

            return response()->json(['status' => 'success']);

        }else{

            return response()->json(['status' => 'error']);

        }
    }

}