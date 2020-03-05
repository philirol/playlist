<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegisterStep2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showForm()
    {
        $villes = DB::table('villes')->where('ville_departement', '=', session('departement_code'))
        ->select('id', 'ville_nom', 'ville_code_postal')
        ->get();

        return view('auth.register_step2', compact('villes'));
    }

    public function postForm(Request $request)
    {          
        $band_id = Auth::user()->band_id;
        $id = $request->id;
        DB::table('bands')
            ->where('id',$band_id)
            ->update (['ville_id' => $id]);
       
        return redirect()->route('home');       
        
    }    
}