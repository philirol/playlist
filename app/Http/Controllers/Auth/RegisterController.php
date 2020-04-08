<?php

namespace App\Http\Controllers\Auth;

use App\{User,Invitation};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

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
    // protected $redirectTo = '/register-step2';
    protected $redirectTo = '/home';

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
    protected function validatorLead(array $data)
    {
        return Validator::make($data, [
            // 'band_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'bandname' => ['required', 'string', 'min:2']
            // 'departement' => ['required', 'numeric', 'min:2', 'max:2']
        ]);
    }

    protected function validatorMember(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createLead(array $data)
    {             
        //session(['departement_code' => $data['departement_code']]);
        
        $id = DB::table('bands')->insertGetId([
            'bandname' => $data['bandname'],
            'slug' => Str::slug($data['bandname'], '-'),
        ]);
        
        return User::create([
            'band_id' => $id,
            'name' => $data['name'],
            'leader' => 1,
            'email' => $data['email'],
            // 'password' => $data['password'], (je sais plus pourquoi je n'avais pas crypté le mdp)
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function createMember(array $data) //test http://localhost/playlist_laravel58/public/inv/9d5b629f-2428-423a-8f9e-4b2f05a0ed62
    {             
        $uid = $data['inv'];
        $invit = Invitation::find($uid);  //the goal is getting the leader_id in invitations table. uid is defined as the primary key in the model so "find($uid)" is possible
        $user = User::find($invit->user_id); //the final goal is finding the band_id with the user_id
        $invit->confirmed = 1;
        $invit->update();
                
        return User::create([
            'band_id' => $user->band_id,
            'name' => $data['name'],
            'leader' => 0,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
