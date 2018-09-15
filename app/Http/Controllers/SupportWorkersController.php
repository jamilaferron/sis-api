<?php

namespace App\Http\Controllers;

use App\SocialWorker;
use Illuminate\Http\Request;
use App\User;
use App\Address;
use App\SupportWorker;
use DB;

class SupportWorkersController extends Controller
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
        $supportWorkers = DB::table('users')->join('support_workers', 'support_workers.user_id', '=', 'users.id')->get();
        $supportWorker = SupportWorker::orderBy('created_at', 'desc')->paginate(10);
        return view('supportWorkers.index',compact('supportWorkers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supportWorkers.create');
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
            'name' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'dbs' => 'required',
            'contract_type' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'specialities' => 'required',
            'line1' => 'required',
            'town' => 'required',
            'postcode' => 'required'

        ]);


            $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
            $starttimes = $request->input('start_time');
            $endtimes = $request->input('end_time');
            for ($i = 0; $i< count($starttimes); $i++)
            {
                if($starttimes[$i] == null || $endtimes[$i] == null)
                {
                    $times[$i] = 'Unavailable';
                }
                else
                {
                    $times[$i] = $starttimes[$i]. " - " .$endtimes[$i];
                }

            }

            for ($i = 0; $i< count($days); $i++)
            {
                $availability[$days[$i]] = $times[$i];
            }

            $user = DB::table('users')->where('email', '=', $request->input('email'))
                ->orWhere('dbs_num', '=', $request->input('dbs'))->first();

            if($user != null)
            {
                if($user->email == $request->input('email'))
                {
                    return redirect('/supportWorkers')->with('error', 'This email has been assigned');
                }
                elseif($user->dbs_num == $request->input('dbs'))
                {
                    return redirect('/supportWorkers')->with('error', 'This DBS number is already in the system');
                }
            }
            else
            {
                if($request->input('gender') == 'female')
                {
                    $fileNameToStore = 'avatarF.jpg';
                }
                elseif ($request->input('gender') == 'male')
                {
                    $fileNameToStore = 'avatarM.jpg';
                }

                $address = DB::table('addresses')->where([['line1', '=', $request->input('line1')],
                    ['town_city', '=', $request->input('town')],
                    ['postcode', '=', $request->input('postcode')],
                ])->first();

                if($address != null)
                {
                    $address_id = $address->id;
                    $supportWorker = DB::table('users')->where('user_name', '=',$request->input('name'))
                        ->where('dob', '=', $request->input('dob'))
                        ->where('gender', '=', $request->input('gender'))
                        ->where('address_id','=', $address_id)
                        ->where('role','=', 'support worker')->first();
                    if($supportWorker != null)
                    {
                        return redirect('/supportWorkers')->with('error', 'This Support Worker already exists');
                    }
                    else
                    {
                        $supportWorker_id = DB::table('users')->insertGetId([
                            'user_name' => $request->input('name'),
                            'email' => $request->input('email'),
                            'dbs_num' => $request->input('dbs'),
                            'address_id' => $address_id,
                            'dob' => $request->input('dob'),
                            'gender' => $request->input('gender'),
                            'role' => 'support worker',
                            'profile_image' => $fileNameToStore,
                        ]);

                        DB::table('support_workers')->insert([
                            'user_id' => $supportWorker_id,
                            'contract_type' => $request->input('contract_type'),
                            'availability' => json_encode($availability),
                            'specialities' => json_encode($request->input('specialities'))
                        ]);
                        return redirect('/supportWorkers')->with('success', 'Support Worker added');

                    }
                }
                else
                {
                    $address_id = DB::table('addresses')->insertGetId(['address_type' => 'Home',
                        'line1' => $request->input('line1'),
                        'line2' => $request->input('line2'),
                        'town_city' => $request->input('town'),
                        'county' => $request->input('county'),
                        'postcode' => $request->input('postcode'),
                    ]);
                    $supportWorker = DB::table('users')->where('user_name', '=',$request->input('name'))
                        ->where('dob', '=', $request->input('dob'))
                        ->where('gender', '=', $request->input('gender'))
                        ->where('address_id','=', $address_id)
                        ->where('role','=', 'support worker')->first();
                    if($supportWorker != null)
                    {
                        return redirect('/supportWorkers')->with('error', 'This Support Worker already exists');
                    }
                    else
                    {
                        $supportWorker_id = DB::table('users')->insertGetId([
                            'user_name' => $request->input('name'),
                            'email' => $request->input('email'),
                            'dbs_num' => $request->input('dbs'),
                            'address_id' => $address_id,
                            'dob' => $request->input('dob'),
                            'gender' => $request->input('gender'),
                            'role' => 'support worker',
                            'profile_image' => $fileNameToStore,
                        ]);
                        DB::table('support_workers')->insert([
                            'user_id' => $supportWorker_id,
                            'contract_type' => $request->input('contract_type'),
                            'availability' => json_encode($availability),
                            'specialities' => json_encode($request->input('specialities'))
                        ]);

                        return redirect('/supportWorkers')->with('success', 'Support Worker added');

                    }

                }

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

       $supportWorkers = DB::table('users')
             ->where('support_workers.id','=', $id)
           ->join('addresses', 'users.address_id', '=', 'addresses.id')
           ->join('support_workers', 'users.id', '=', 'support_workers.user_id')
            ->get();

        return view('supportWorkers.show')->with('supportWorkers', $supportWorkers);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supportWorker = SupportWorker::find($id);
        return view('supportWorkers.edit')->with('supportWorker', $supportWorker);
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
            'name' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'dbs' => 'required',
            'line1' => 'required',
            'town' => 'required',
            'county' => 'required',
            'postal_code' => 'required',
            'contract_type' => 'required',
            'availability' => 'required',
            'specialities' => 'required',
            'gender' => 'required',
            'profile_image' => 'image|nullable|max:1999'
        ]);


       $supportWorker = SupportWorker::find($id);
        $user = User::where('id', $supportWorker->user_id)->first();

        DB::table('support_workers')->where('id', '=', $id)->update([
            'contract_type' => $request->input('contract_type'),
            'availability' => $request->input('availability'),
            'specialities' => $request->input('specialities'),
        ]);

        DB::table('users')->where('id', '=', $supportWorker->user_id)->update([
            'user_name' => $request->input('name'),
            'email' => $request->input('email'),
            'dbs_num' => $request->input('dbs'),
            'dob' => $request->input('dob'),
        ]);

        DB::table('addresses')->where('id', '=', $user->address_id)->update([
            'line1' => $request->input('line1'),
            'line2' => $request->input('line2'),
            'town' => $request->input('town'),
            'county' => $request->input('county'),
            'address_type' => $request->input('address_type'),
            'postal_code' => $request->input('postal_code'),
        ]);

        return redirect('/supportWorkers/'.$supportWorker->id)->with('success', 'User Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supportWorker = SupportWorker::find($id);
        $supportWorker->delete();
        return redirect('/supportWorkers')->with('success', 'Support Worker Removed');
    }
}
