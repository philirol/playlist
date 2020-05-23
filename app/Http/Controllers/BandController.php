<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Helpers\BandHelper;
use App\{Songsub, Media, Band};
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Band as BandRequest;
use Illuminate\Http\Request;
use App\Traits\DeleteSong;
use App\Traits\SubscriptionControlTrait;
use Stripe\Stripe;
use Illuminate\Support\Facades\Storage;

class BandController extends Controller
{
    use DeleteSong;
    use SubscriptionControlTrait;

    public function __construct()
    {    
        $this->middleware('members')->except(['show','edit']); 
        $this->middleware('leader')->only(['create','update','destroy']);
        $this->middleware('admin')->only(['showByAdmin']);    
    }
    
    public function index($sort)
    {
        $bands = Band::withCount(['songs','users'])->orderBy($sort)->get(); 
        $bandnumber = count($bands);
        return view('band.index', compact('bands','bandnumber'));               
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByAdmin(Band $band) //pour l'admin avec choix du groupe, provenant de band.index
    {        

        return view('band.show', compact('band'));
    }

    public function show() //pour les users
    {
        $band = Bandhelper::getBand();
        return view('band.show', compact('band'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Band $band)
    {        
        // $departement = Departement::all();
        // $ville = Ville::where('id', $band->ville_id)->get(); //Villes en suspens
        $this->authorize('update', $band);
        return view('band.edit', compact('band'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BandRequest $BandRequest, Band $band)
    {
        $this->authorize('update', $band);
        $band->update($this->params($BandRequest));
        return redirect()->route('band.show')->with('message', __('Le groupe a bien été modifié'));
    }

    private function params(Request $request){
        return $request->all();
    }

    public function delete(){
        $band = Auth::user()->band;
        return view('band.delete', compact('band'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Band $band){
        // $leader = Auth::user();
       /*  DB::table('songsubs')->where('user_id',$leader->id)->delete();
        DB::table('songs')->where('user_id',$leader->id)->delete(); */

        foreach ($band->users as $user){ 
            foreach($user->songs as $songtodelete){
            $this->deleteSong($songtodelete);
            }           
        }

        foreach ($band->users as $user){ 
            foreach($user->donations as $don){
                $don->delete();
                }       
        }
        foreach ($band->users as $user){ 
            foreach($user->invitations as $invit){
                $invit->delete();
                }       
        }

        foreach ($band->users as $user){ 
            if($user->stripe_id <> null){
                Stripe::setApiKey(env("STRIPE_SECRET"));
                $customer = \Stripe\Customer::retrieve($user->stripe_id);
                $customer->delete();
            }
            DB::table('subscriptions')->where('user_id',$user->id)->update(['stripe_status' => 'user_deleted', 'updated_at' => date('Y-m-d G:i:s')]);
            $user->delete();           
        }
        $band->delete();
        return redirect()->route('login');
    }

    public function storedfilelist(){

        $files_with_size = array();
        $files = Storage::disk('public')->files(Auth::user()->band->slug);
        $size1= 0;        
        foreach ($files as $key => $file) {
            $size1 += $files_with_size[$key]['size'] = Storage::disk('public')->size($file);            
        }
        
        $songsubs = Songsub::type()->where('band_id', Auth::user()->band_id)->orderBy('created_at','desc')->get();
        $size2a = $songsubs->sum('filesize');
        
        $medias = Media::where('band_id', Auth::user()->band_id)->orderBy('created_at','desc')->get();
        $size2b = $medias->sum('filesize');
        // dd($size2b);

        $size2 = $size2a + $size2b;

        $plans = $this->BandPlan();
        foreach ($plans as $plan) {
            $limitUpload = $plan->bitval;
            $planName = $plan->name;
        }
        
        
        // size1 gives the total size of the band directory
        // size2 do the same but with the values registered in the database for each file
        // both must give the same value

        return view('band.storedfilelist', compact('songsubs', 'medias', 'size1', 'size2a', 'size2b', 'limitUpload','planName'));
    } 
}

