<?php

namespace App\Http\Controllers;


use App\SupportWorker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use App\SupportSession;
use App\ServiceUser;
use App\Address;
use App\Report;
use DB;

use MaddHatter\LaravelFullcalendar\Calendar;

class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {


        $sessions = SupportSession::all();
        $serviceUsers = ServiceUser::all()->where('active', true);
        $addresses = Address::all()->where('address_type', 'Home');
        $supportWorkers = DB::table('users')->join('support_workers', 'users.id', '=', 'support_workers.user_id')
            ->select('users.user_name', 'support_workers.id','support_workers.user_id', 'users.active')
            ->get();
        $sessionTypes = DB::table('service_types')->get();
        $sessionsInfos = DB::table('support_sessions')->join('service_users', 'support_sessions.serviceuser_id', '=', 'service_users.id')
            ->join('support_workers', 'support_sessions.supportworker_id', '=', 'support_workers.id')
            ->join('users', 'users.id', '=', 'support_workers.user_id')
            ->select('support_sessions.session_type','support_sessions.start_date', 'support_sessions.start_time', 'support_sessions.end_time', 'users.user_name', 'support_workers.id','support_workers.user_id', 'service_users.id', 'service_users.su_name')
            ->get();

        return view('sessions.index', compact( 'serviceUsers', 'supportWorkers','sessions', 'sessionTypes', 'addresses', 'sessionsInfos'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'session_type' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'supportworker' => 'required',
            'serviceuser' => 'required',
            'address' => 'required',

        ]);


        $session = new SupportSession;
        $session->session_type = $request['session_type'];
        $session->start_date = $request['start_date'];
        $session->start_time = $request['start_time'];
        $session->end_time = $request['end_time'];
        $session->supportworker_id = $request['supportworker'];
        $session->serviceuser_id = $request['serviceuser'];
        $session->pickup_address = $request['address'];
        $session->save();

        return redirect('/sessions')->with('success', 'Session added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $session = SupportSession::find($id);

        $supportworker = SupportWorker::find($session->supportworker_id);

        return view('sessions.show')->with('session', $session)->with('supportworker', $supportworker);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $session = SupportSession::find($id);
        if($request['time'] == 'startTime')
        {
            if($session->actual_end_time != null)
            {
                return Redirect::back()->with('error', 'the session has already ended');
            }
            elseif($session->actual_start_time == null)
            {
                $session->actual_start_time = Carbon::now();
                $session->updated_at = Carbon::now();
                $session->save();
                return Redirect::back()->with('success', 'session started');
            }
            else
            {
                return Redirect::back()->with('error', 'the session has already started');
            }

        }
        elseif($request['time'] == 'endTime')
        {
            if($session->actual_start_time == null)
            {
                return Redirect::back()->with('error', 'the session has not started');
            }
            elseif($session->actual_end_time == null)
            {

                $session->actual_end_time = Carbon::now();
                $session->updated_at = Carbon::now();
                $session->report_deadline = Carbon::now()->adddays(2);
                $session->save();
                return Redirect::back()->with('success', 'session ended');
            }
            else
            {
                return Redirect::back()->with('error', 'the session has already ended');
            }

        }
        elseif($request['image'] == 'secret')
        {
            $this->validate($request, [

                'cover_image' => 'required|max:1999|mimes:doc,docx'
            ]);

            // Handle File Upload
            if($request->hasfile('cover_image'))
            {
                $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('cover_image')->getClientOriginalExtension();

                // File name to store
                $fileNameToStore = $filename.'_'.$session->id.'_'.time().'.'.$extension;

                //Upload Image
                $request->file('cover_image')->storeAs('public/profile_images', $fileNameToStore);
            }

            $supportworker = SupportWorker::find($session->supportworker_id);
            $report_id = DB::table('reports')->insertGetId(['submitted_by' => $supportworker->user_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'report' => $fileNameToStore
                ]);
            // Create Post

            $session->report_id = $report_id;
            $session->save();
            return Redirect::back()->with('success', 'report submitted');
        }





        //
    }

    public function startSession(Request $request, $id)
    {



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
