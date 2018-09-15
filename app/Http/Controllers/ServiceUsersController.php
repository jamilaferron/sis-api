<?php

namespace App\Http\Controllers;

use App\SupportSession;
use Illuminate\Http\Request;
use App\ServiceUser;
use App\Address;
use App\SocialWorker;
use App\SupportWorker;
use DB;
use Illuminate\Support\Facades\Redirect;

class ServiceUsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supportWorkers = SupportWorker::all();
        $serviceUsers = ServiceUser::orderBy('created_at', 'desc')->paginate(10);
       $sessionsInfos = DB::table('support_sessions')
           ->join('service_users', 'support_sessions.serviceuser_id', '=', 'service_users.id')
            ->join('support_workers', 'support_sessions.supportworker_id', '=', 'support_workers.id')
           ->join('users', 'users.id', '=', 'support_workers.user_id')
           ->select('support_sessions.session_type','support_sessions.start_date', 'support_sessions.start_time', 'support_sessions.end_time', 'users.user_name', 'support_workers.id','support_workers.user_id', 'service_users.id', 'service_users.su_name')
           ->get();
        return view('serviceUsers.index',compact('supportWorkers', 'serviceUsers', 'sessionsInfos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('serviceUsers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'suname' => 'required',
            'dob' => 'required',
            'needs' => 'required',
            'background' => 'required',
            'suline1' => 'required',
            'sutown' => 'required',
            'sucounty' => 'required',
            'supostal_code' => 'required',
            'suaddress_type' => 'required',
            'swname' => 'required',
            'team' => 'required',
            'email' => 'required',
            'local_authority' => 'required',
            'swline1' => 'required',
            'swtown' => 'required',
            'swcounty' => 'required',
            'swpostal_code' => 'required',
            'swaddress_type' => 'required'

        ]);

        $serviceUser = DB::table('service_users')->where('su_name', '=', $request->input('name'))
            ->where('dob', '=', $request->input('dob'))->first();

        if($serviceUser != null)
        {
            return redirect('/serviceUsers/create')->with('error', 'This Services User Exists');
        }
        else
        {
            $suaddress = DB::table('addresses')->where('line1', '=', $request->input('suline1'))
                                               ->where('town_city', '=', $request->input('sutown'))
                                               ->where('county', '=', $request->input('sucounty'))
                                               ->where('postcode', '=', $request->input('supostal_code'))->first();
            if($suaddress != null )
            {
                $suaddress_id = $suaddress->id;

            }
            else
            {
                $suaddress_id = DB::table('addresses')->insertGetId(['address_type' => $request->input('suaddress_type'),
                    'line1' => $request->input('suline1'),
                    'line2' => $request->input('suline2'),
                    'town_city' => $request->input('sutown'),
                    'county' => $request->input('sucounty'),
                    'postcode' => $request->input('supostal_code')]);
            }

            $social_worker = DB::table('social_workers')->where('email', '=', $request->input('email'))->first();
            if($social_worker != null )
            {
                $socialworker_id = $social_worker->id;

            }
            else
            {
                $swaddress = DB::table('addresses')->where('line1', '=', $request->input('swline1'))
                                                    ->where('town_city', '=', $request->input('swtown'))
                                                    ->where('county', '=', $request->input('swcounty'))
                                                    ->where('postcode', '=', $request->input('swpostal_code'))->first();
                if($swaddress != null )
                {
                    $swaddress_id = $swaddress->id;

                }
                else
                {
                    $swaddress_id = DB::table('addresses')->insertGetId(['address_type' => $request->input('swaddress_type'),
                                                                        'line1' => $request->input('swline1'),
                                                                        'line2' => $request->input('swline2'),
                                                                        'town_city' => $request->input('swtown'),
                                                                        'county' => $request->input('swcounty'),
                                                                        'postcode' => $request->input('swpostal_code')]);
                }
                $socialworker_id = DB::table('social_workers')->insertGetId(['sw_name' => $request->input('swname'),
                                                                            'team' => $request->input('team'),
                                                                            'email' => $request->input('email'),
                                                                            'address_id' => $swaddress_id,
                                                                            'local_authority' => $request->input('local_authority')]);

            }

            $serviceUser = new ServiceUser;
            $serviceUser->su_name = $request->input('suname');
            $serviceUser->dob = $request->input('dob');
            $serviceUser->needs = json_encode($request->input('needs'));
            $serviceUser->background_info = $request->input('background');
            $serviceUser->address_id = $suaddress_id;
            $serviceUser->socialworker_id = $socialworker_id;
            $serviceUser->save();
            return redirect('/serviceUsers')->with('success', 'Service User Added');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $serviceUser = ServiceUser::find($id);
        $sessions = SupportSession::where('serviceuser_id', '=', $id)->get();
        return view('serviceUsers.show')->with('serviceUser', $serviceUser)
            ->with('sessions', $sessions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serviceUser = ServiceUser::find($id);
        return view('serviceUsers.edit')->with('serviceUser', $serviceUser);
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
        //
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'dob' => 'required',
            'needs' => 'required',
            'local_authority' => 'required'
        ]);

        // Create Service User
        $serviceUser = ServiceUser::find($id);
        $serviceUser->firstname = $request->input('firstname');
        $serviceUser->lastname = $request->input('lastname');
        $serviceUser->dob = $request->input('dob');
        $serviceUser->needs = $request->input('needs');
        $serviceUser->local_authority = $request->input('local_authority');
        $serviceUser->save();
        return redirect('/serviceUsers')->with('success', 'Service User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serviceUser = ServiceUser::find($id);
        $serviceUser->delete();
        return redirect('/serviceUsers')->with('success', 'Service User Removed');
    }
}
