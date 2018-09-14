<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceUserResource;
use App\ServiceUser;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;


class ServiceUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceusers = ServiceUser::all();

        //return response()->json($serviceusers);
        return ServiceUserResource::collection(ServiceUser::with('sessions')->paginate(15));
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
            'dob' => 'required',
    ]);
        if($validator->fails())
        {
           $response = array('response' => $validator->messages(), 'success' => false);
           return $response;
        }
        else
        {
            // Create ServiceUser
            $serviceuser = new ServiceUser;
            $serviceuser->name = $request->input('name');
            $serviceuser->dob = $request->input('dob');
            $serviceuser->save();

            return response()->json($serviceuser);
            //return new ServiceUserResource($serviceuser);
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
        return new ServiceUserResource(ServiceUser::find($id));
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
            'dob' => 'required',
        ]);
        if($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            // Find ServiceUser
            $serviceuser = ServiceUser::find($id);
            $serviceuser->dob = $request->input('dob');
            $serviceuser->save();

            //return response()->json($serviceuser);
            return new ServiceUserResource($serviceuser);
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
        $serviceuser = ServiceUser::find($id);
        $serviceuser->delete();

        $response = array('response' => 'Service User deleted', 'success' => true);
        return $response;
    }
}
