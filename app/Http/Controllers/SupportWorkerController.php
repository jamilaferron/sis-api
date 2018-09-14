<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupportWorkerResource;
use App\SupportWorker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;


class SupportWorkerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SupportWorkerResource::collection(SupportWorker::with('sessions')->paginate(15));
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
            'contract_type' => 'required',
            'availability' => 'required',
            'specialities' => 'required',

        ]);

        if($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
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

            $user = User::find($request->name);

            // Create ServiceUser
            $supportworker = new SupportWorker;
            $supportworker->user_id = $user->id;
            $supportworker->contract_type = $request->input('contract_type');
            $supportworker->availability = json_encode($availability);
            $supportworker->specialities = json_encode($request->input('specialities'));
            $supportworker->save();

            //return response()->json($user);
            return response()->json($supportworker);
            //return new SupportWorkerResource($supportworker);
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  SupportWorker  $supportworker
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new SupportWorkerResource($id);
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
            'contract_type' => 'required',
            'availability' => 'required',
            'specialities' => 'required',

        ]);

        if($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
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

            $user = User::find($request->name);

            // Create ServiceUser
            $supportworker = SupportWorker::find($id);
            $supportworker->contract_type = $request->input('contract_type');
            $supportworker->availability = json_encode($availability);
            $supportworker->specialities = json_encode($request->input('specialities'));
            $supportworker->save();

            //return response()->json($user);
            return response()->json($supportworker);
            //return new SupportWorkerResource($supportworker);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  SupportWorker  $supportworker
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supportworker = User::find($id);
        $supportworker->delete();

        $response = array('response' => 'User deleted', 'success' => true);
        return $response;
    }
}
