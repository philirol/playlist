<?php

namespace App\Http\Controllers\Auth;

use App\{User,Invitation};
use App\Events\NewUserEvent;
use App\Http\Controllers\Controller;
use App\Notifications\NewUser;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    use RegistersUsers;
    // protected $redirectTo = '/register-step2';

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request) //surcharge register du trait RegistersUsers
    {
        if(!$request->inv){
            $this->validatorLead($request->all())->validate();
            event(new Registered($user = $this->createLead($request->all())));     

        }else{
            $this->validatorMember($request->all())->validate();
            event(new Registered($user = $this->createMember($request->all()))); 
        }
        $user->createAsStripeCustomer();

        event(new NewUserEvent($user)); //to Mailable::NotifyAdminNewUserMail -> NotifyAdminNewUser.blade.php        
        $user->notify(new NewUser($user)); //to Notification::NewUser.php (welcome message to new User)
        $this->guard()->login($user);     

        return $this->registered($request, $user) ? : redirect($this->redirectPath());
    }

    protected function createLead(array $data)
    {             
        $slug = Str::slug($data['bandname'], '-');
            do{$slug = $slug.rand(1,99);}
            while(\App\Band::firstwhere('slug',$slug));                

        $id = DB::table('bands')->insertGetId([
            'bandname' => $data['bandname'],
            'slug' => $slug,
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

    protected function validatorLead(array $data)    {
        return Validator::make($data, [
            // 'band_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'bandname' => ['required', 'string', 'min:2', 'max:30']
        ]);
    }

    protected function validatorMember(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    
    public function registertest(Request $request){
        $user = new User;
        $user->name = $request->name;        
        $user->email = $request->email;
        $user->leader = 1;
        $user->bandname = $request->bandname;
        $user->password = $request->password;
        $user->created_at = new Datetime('now');
        return view($user->notify(new NewUser($user))->render()); //to Notification::NewUser.php (welcome message to new User)
    }
}
