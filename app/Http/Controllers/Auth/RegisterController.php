<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\County;
use App\Models\Subcounty;

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
    public function showRegistrationForm()
    {
        $counties=County::all();
        $subcounties=Subcounty::all();
        //dd($counties);
        return view('auth.register',compact('counties','subcounties'));
    }

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:25|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|max:13|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'access_level' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       //exit;
         if($data['access_level'] == 'County Administrator'){
          $data['subcounty'] = 0;
         }
         else if($data['access_level'] == 'Sub-County Administrator'){
           //$county = Subcounty::where("")
           $data['county'] = 0;
         }
         else{
           $data['county'] = 0;
           $data['subcounty'] = 0;
         }

         /*$user = new User;
         $user->county_id = $data['county'];
         $user->subcounty_id = $data['subcounty'];
         $user->name = $data['name'];
         $user->username = $data['username'];
         $user->email = $data['email'];
         $user->mobile = $data['mobile'];
         $user->access_level = $data['access_level'];
         $user->password = Hash::make($data['password']);
         $user->save();*/

         //dd($data);
        return User::create([
            'county_id' => $data['county'],
            'subcounty_id' => $data['subcounty'],
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'access_level' => $data['access_level'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
