<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class UsersController extends Controller
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
        //$user = User::orderBy('created_at', 'desc')->paginate(10);
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return view('users.index')->with('users', $users);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'role' => 'required',
            'line1' => 'required',
            'town' => 'required',
            'postcode' => 'required'

        ]);

        if ($request->input('role') == 'Support Worker')
        {
            $this->validate($request, [
                'dbs' => 'required',
                'contract_type' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'specialities' => 'required'

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
                    return redirect('/users')->with('error', 'This email has been assigned');
                }
                elseif($user->dbs_num == $request->input('dbs'))
                {
                    return redirect('/users')->with('error', 'This DBS number is already in the system');
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
                        ->where('role','=', $request->input('role'))->first();
                    if($supportWorker != null)
                    {
                        return redirect('/users')->with('error', 'This Support Worker already exists');
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
                            'role' => $request->input('role'),
                            'profile_image' => $fileNameToStore,
                        ]);

                        DB::table('support_workers')->insert([
                            'user_id' => $supportWorker_id,
                            'contract_type' => $request->input('contract_type'),
                            'availability' => json_encode($availability),
                            'specialities' => json_encode($request->input('specialities'))
                        ]);
                        return redirect('/users')->with('success', 'Support Worker added');

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
                        ->where('role','=', $request->input('role'))->first();
                    if($supportWorker != null)
                    {
                        return redirect('/users')->with('error', 'This Support Worker already exists');
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
                            'role' => $request->input('role'),
                            'profile_image' => $fileNameToStore,
                        ]);
                        DB::table('support_workers')->insert([
                            'user_id' => $supportWorker_id,
                            'contract_type' => $request->input('contract_type'),
                            'availability' => json_encode($availability),
                            'specialities' => json_encode($request->input('specialities'))
                        ]);

                        return redirect('/users')->with('success', 'Support Worker added');

                    }

                }

            }
        }
        else
        {
            $user = DB::table('users')->where('email', '=', $request->input('email'))->first();

            if($user != null)
            {
                if($user->email == $request->input('email'))
                {
                    return redirect('/users')->with('error', 'This email has been assigned');
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
                    $user = DB::table('users')->where('user_name', '=',$request->input('name'))
                        ->where('dob', '=', $request->input('dob'))
                        ->where('gender', '=', $request->input('gender'))
                        ->where('address_id','=', $address_id)
                        ->where('role','=', $request->input('role'))->first();
                    if($user != null)
                    {
                        return redirect('/users')->with('error', 'This User already exists');
                    }
                    else
                    {
                        DB::table('users')->insert([
                            'user_name' => $request->input('name'),
                            'email' => $request->input('email'),
                            'address_id' => $address_id,
                            'dob' => $request->input('dob'),
                            'gender' => $request->input('gender'),
                            'role' => $request->input('role'),
                            'profile_image' => $fileNameToStore,
                        ]);

                        return redirect('/users')->with('success', 'User added');

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
                    $user = DB::table('users')->where('user_name', '=',$request->input('name'))
                        ->where('dob', '=', $request->input('dob'))
                        ->where('gender', '=', $request->input('gender'))
                        ->where('address_id','=', $address_id)
                        ->where('role','=', $request->input('role'))->first();
                    if($user != null)
                    {
                        return redirect('/users')->with('error', 'This User already exists');
                    }
                    else
                    {
                        DB::table('users')->insert([
                            'user_name' => $request->input('name'),
                            'email' => $request->input('email'),
                            'address_id' => $address_id,
                            'dob' => $request->input('dob'),
                            'gender' => $request->input('gender'),
                            'role' => $request->input('role'),
                            'profile_image' => $fileNameToStore,
                        ]);

                        return redirect('/users')->with('success', 'User added');

                    }

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
        $user = User::find($id);

        if($user->role == "superAdmin")
        {
            $user = User::find($id);
        }
        elseif($user->role == "admin" || $user->role == "manager" )
        {
            $user = DB::table('users')
                ->where('users.id','=', $id)
                ->join('addresses', 'users.address_id', '=', 'addresses.id')
                ->first();

        }
        elseif($user->role == "support worker")
        {
            $user = DB::table('users')
                ->where('users.id','=', $id)
                ->join('addresses', 'users.address_id', '=', 'addresses.id')
                ->join('support_workers', 'users.id', '=', 'support_workers.user_id')
                ->first();

        }

        return view('users.show')->with('user', $user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')->with('user', $user);
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
            'gender' => 'required',
            'role' => 'required',
            'profile_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasfile('profile_image'))
        {
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile_image')->getClientOriginalExtension();

            // File name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload Image
            $request->file('profile_image')->storeAs('public/profile_images', $fileNameToStore);
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

        }

        $user = DB::table('users')->where('id', '=', $id)
            ->orWhere('email', '=', $request->input('email'))
            ->orWhere('dbs_num', '=', $request->input('dbs'))->first();

        if($user != null)
        {
            if($user->id != $id && $user->dbs == $request->input('dbs') )
            {
                return redirect('/users')->with('error', 'This DBS number is already assigned to another user');
            }
            elseif($user->id != $id && $user->email == $request->input('email'))
            {
                return redirect('/users')->with('error', 'This email is already assigned to another user');
            }
        }

        $address = DB::table('addresses')->where([['line1', '=', $request->input('line1')],
            ['town', '=', $request->input('town')],
            ['county', '=', $request->input('county')],
            ['postal_code', '=', $request->input('postal_code')],
        ])->first();

        if($address != null)
        {

            // Update User
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->dob = $request->input('dob');
            $user->email = $request->input('email');
            $user->dbs = $request->input('dbs');
            $user->address_id = $address->id;
            $user->gender = $request->input('gender');
            $user->role = $request->input('role');
            $user->profile_image = $fileNameToStore;
            $user->save();
            return redirect('/users')->with('success', 'User Updated');

        }
        else
        {
            $address_id = DB::table('addresses')->insertGetId(['address_type' => $request->input('address_type'),
                'line1' => $request->input('line1'),
                'line2' => $request->input('line2'),
                'town' => $request->input('town'),
                'county' => $request->input('county'),
                'postal_code' => $request->input('postal_code'),
            ]);

            // Update User
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->dob = $request->input('dob');
            $user->email = $request->input('email');
            $user->dbs = $request->input('dbs');
            $user->address_id = $address_id;
            $user->gender = $request->input('gender');
            $user->role = $request->input('role');
            $user->profile_image = $fileNameToStore;
            $user->save();
            return redirect('/users')->with('success', 'User Updated');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if($user->role != 'support worker')
        {
            $user->delete();
            return redirect('/users')->with('success', 'User Removed');
        }

    }
}
