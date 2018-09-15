<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceUser;
use App\SupportRequest;
use App\Address;
use App\SocialWorker;
use DB;
use Illuminate\Support\Facades\Redirect;

class SupportRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supportRequest = SupportRequest::orderBy('created_at', 'desc')->paginate(10);
        return view('supportRequests.index')->with('supportRequests', $supportRequest);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supportRequests.create');
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
            'suline1' => 'required',
            'sutown' => 'required',
            'sucounty' => 'required',
            'supostal_code' => 'required',
            'swname' => 'required',
            'team' => 'required',
            'email' => 'required',
            'local_authority' => 'required',
            'swline1' => 'required',
            'swtown' => 'required',
            'swcounty' => 'required',
            'swpostal_code' => 'required'

        ]);

        $serviceUser = DB::table('service_users')->where('name', '=', $request->input('name'))
            ->where('dob', '=', $request->input('dob'))
            ->where('local_authority', '=', $request->input('local_authority'))->first();

        if($serviceUser != null)
        {
            return redirect('/serviceUsers/create')->with('errors', 'This Services User Exists');
        }
        else
        {
            $suaddress = DB::table('addresses')->where('line1', '=', $request->input('suline1'))
                                               ->where('town', '=', $request->input('sutown'))
                                               ->where('county', '=', $request->input('sucounty'))
                                               ->where('postal_code', '=', $request->input('supostal_code'))->first();
            if($suaddress != null )
            {
                $suaddress_id = $suaddress->id;

            }
            else
            {
                $suaddress_id = DB::table('addresses')->insertGetId(['address_type' => $request->input('suaddress_type'),
                    'line1' => $request->input('suline1'),
                    'line2' => $request->input('suline2'),
                    'town' => $request->input('sutown'),
                    'county' => $request->input('sucounty'),
                    'postal_code' => $request->input('supostal_code')]);
            }

            $social_worker = DB::table('social_workers')->where('email', '=', $request->input('email'))->first();
            if($social_worker != null )
            {
                $socialworker_id = $social_worker->id;

            }
            else
            {
                $swaddress = DB::table('addresses')->where('line1', '=', $request->input('swline1'))
                                                    ->where('town', '=', $request->input('swtown'))
                                                    ->where('county', '=', $request->input('swcounty'))
                                                    ->where('postal_code', '=', $request->input('swpostal_code'))->first();
                if($swaddress != null )
                {
                    $swaddress_id = $swaddress->id;

                }
                else
                {
                    $swaddress_id = DB::table('addresses')->insertGetId(['address_type' => $request->input('swaddress_type'),
                                                                        'line1' => $request->input('swline1'),
                                                                        'line2' => $request->input('swline2'),
                                                                        'town' => $request->input('swtown'),
                                                                        'county' => $request->input('swcounty'),
                                                                        'postal_code' => $request->input('swpostal_code')]);
                }
                $socialworker_id = DB::table('social_workers')->insertGetId(['name' => $request->input('swname'),
                                                                            'team' => $request->input('team'),
                                                                            'email' => $request->input('email'),
                                                                            'address_id' => $swaddress_id,
                                                                            'local_authority' => $request->input('local_authority')]);

            }

            $serviceUser = new ServiceUser;
            $serviceUser->name = $request->input('suname');
            $serviceUser->dob = $request->input('dob');
            $serviceUser->needs = $request->input('needs');
            $serviceUser->address_id = $suaddress_id;
            $serviceUser->socialworker_id = $socialworker_id;
            $serviceUser->local_authority = $request->input('local_authority');
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
        $supportRequest = SupportRequest::find($id);
        return view('supportRequests.show')->with('supportRequest', $supportRequest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supportRequest = SupportRequest::find($id);
        return view('supportRequests.edit')->with('supportRequest', $supportRequest);
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
