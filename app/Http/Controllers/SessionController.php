<?php

namespace App\Http\Controllers;

use App\Http\Resources\SessionResource;
use App\ServiceUser;
use App\SupportWorker;
use Illuminate\Http\Request;
use App\Session;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::all();

        //return response()->json($sessions);
        return SessionResource::collection(Session::with('supportworker', 'serviceuser')->paginate(15));
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
            'suname' => 'required',
            'session_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $serviceuser = ServiceUser::find($request->input('suname'));
            $supportworker = SupportWorker::find($request->input('swname'));
            // Create Session
            $session = new Session;
            $session->service_user_id = $serviceuser->id;
            $session->support_worker_id = $supportworker->id;
            $session->session_date = $request->input('session_date');
            $session->start_time = $request->input('start_time');
            $session->end_time = $request->input('end_time');
            $session->save();

            //return response()->json($user);
            return new SessionResource($session);
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
        return new SessionResource(Session::find($id));
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



            // Update Session
            $session = new Session;
            $session->session_date = $request->input('session_date');
            $session->start_time = $request->input('start_time');
            $session->end_time = $request->input('end_time');
            $session->save();

            //return response()->json($session);
            return new SessionResource($session);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $session = Session::find($id);
        $session->delete();

        $response = array('response' => 'Session deleted', 'success' => true);
        return $response;
    }
}

