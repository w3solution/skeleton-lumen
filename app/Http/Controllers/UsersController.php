<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\User;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        

    } 

    public function register( Request $request ) {

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $pass = $request->input('password');
            $user->password = app('hash')->make($pass);

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'message' => 'created'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'user failed register!'], 409);
        }

    }

    public function authenticate(Request $request) {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);


        $user = User::where('email', $request->input('email'))->first();

        if(Hash::check($request->input('password'), $user->password)) {

            $hash = base64_encode(Str::random(40));

            User::where('email', $request->input('email'))->update([
                'hash' => "$hash"
            ]);

            return response()->json(['status' => 'success', 'hash' => $hash]);

        }else{

            return response()->json([
                'status' => 'error'
            ], 401);

        }
    }

    public function get() {

        echo 'asdasdsad';

    }

}
