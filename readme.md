TEST POLICY

return in_array($user->email, ['clyde79@example.org',]); //ok
return !$user->band_id == 0;    

***********************************************************************************************************************************
Test avec Middleawre UserMiddleware.php
<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        // dd(Auth::user()->band_id);
        if (Auth::user() && Auth::user()->band_id == 0){
            // dd('ok');
            return redirect('profil');
        }         
        return $next($request);
    }    
}
**********************************************
DANS ProfilController.php :
public function index()
    {
        $whichFonction = 'index';
        $department = Departement::all()->pluck('departement_code');
        return view('user.profil', compact('department','whichFonction'));
    }
**********************************************
DANS ROUTES :
Route::get('profil', 'ProfilController@indexNewuser');

DANS KERNEL :
$middlewareGroups web :
\App\Http\Middleware\UserMiddleware::class, 
protected $routeMiddleware :
'newuser' => \App\Http\Middleware\UserMiddleware::class,
***********************************************************************************************************************************

TO DO
En admin, la création d'une song est toujours faite dans la playlist de l'admin : comportement normal en prod mais pas en démo

***********************************************************************************************************************************

MIGRATION
php artisan migrate:fresh
php artisan db:seed
Importer le fichier villes_france.sql et renommer la table en "villes"

***********************************************************************************************************************************
FORMULAIRE HTML
Installation des composants Form et Html pour les formulaires partie admin le 11/02/20

***********************************************************************************************************************************

LISTE DEROULANTE DES GROUPES (au besoin)
<div class="field">
<label class="label">Groupe</label>
    <div class="select">
        <select name="band_id">
            @foreach($band as $band)
                <option value="{{ $band->id }}" {{ $song->band_id == $band->id ? 'selected' : ''}}>{{ $band->bandname }}</option>                
            @endforeach                                          
        </select>
    </div>
</div>

