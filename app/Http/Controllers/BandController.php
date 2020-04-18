<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Band;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Band as BandRequest;
use Illuminate\Http\Request;
use App\Traits\DeleteSong;
use Stripe\Stripe;

class BandController extends Controller
{
    use DeleteSong;

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
        $band = new Band;
        $villes = DB::table('villes')
                            ->select('id', 'ville_nom', 'ville_code_postal')
                            //->whereBetween('id', [1,100])
                            ->orderBy('ville_nom')
                            ->get();
        return view('band.create', compact('band','villes'));
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
        
        // dd($band->bandname);
        return view('band.show', compact('band'));
    }

    public function show() //pour les users
    {
        Auth::check() ? $band = Auth::user()->band : $band = Band::find(1);
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
            Stripe::setApiKey(env("STRIPE_SECRET"));
            $customer = \Stripe\Customer::retrieve($user->stripe_id);
            $customer->delete();
            DB::table('subscriptions')->where('user_id',$user->id)->update(['stripe_status' => 'user_deleted', 'updated_at' => date('Y-m-d G:i:s')]);
            $user->delete();            
        }    
        $band->delete();
        return redirect()->route('login');
    }
}
        
        
        


