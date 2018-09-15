<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users);
        //return UserResource::collection(User::with('supportworker')->paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'role' => 'required',
            'line1' => 'required',
            'town' => 'required',
            'postcode' => 'required'
        ]);

        if($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {

            // Create ServiceUser
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            //return response()->json($user);
            return response()->json($user);
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  ServiceUser $serviceuser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserResource(User::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'exists:users',
            'password' => 'required',
        ]);

        if($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            // Update user
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->password = $request->input('password');
            $user->save();

            return response()->json($user);
            //return new UserResource($user);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ServiceUser $serviceuser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();

        $response = array('response' => 'User deleted', 'success' => true);
        return $response;
    }
}
