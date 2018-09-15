<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use PhpParser\Node\Stmt\Return_;
use App\Mail\VerifyMail;
use App\VerifyUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|exists:users,user_name',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => array(
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{10,})/',
                'min:10',
                'dumbpwd',
                'confirmed'),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     *
     * protected function create(array $data)
     * {
     * return User::create([
     * 'name' => $data['name'],
     * 'username' => $data['username'],
     * 'email' => $data['email'],
     * 'password' => Hash::make($data['password']),
     * ]);
     * }
     */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     *
     */

    protected function create(array $data)
    {
        DB::table('users')->where('email', '=', $data['email'])->update([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        $user = DB::table('users')->where('email', '=', $data['email'])->first();
        $user = User::find($user->id);

        DB::table('verify_users')->insert([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);


        Mail::to($user->email)->send(new VerifyMail($user));

        return $user;
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }

        return redirect('/login')->with('status', $status);
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
    }
}
