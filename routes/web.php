<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Songsub;

Route::fallback(function(){
    return view('errors/fallback');
});

Route::middleware('members')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::get('SubscribedPlan','SongsubController@showPlan');
    Route::get('/strd/files', 'BandController@storedfilelist')->name('storedfilelist');
    Route::get('user/{user}', 'UserController@show')->name('user.show');
    Route::get('deleteImage/{user}', 'UserController@deleteImage')->name('user.deleteImage');
    Route::delete('customer/{user}', 'UserController@customerdestroy')->name('customer.destroy');
    // Route::delete('user/{user}', 'UserController@destroy')->name('user.destroy');
    Route::get('user/{user}/delete', ['as' => 'user.delete', 'uses' => 'UserController@delete']); //I prefer use a link with get verb. Not secure but Policy & middleware protect
    Route::resource('user', 'UserController')->except(['deleteImage','indexByAdmin']);
    
    Route::get('/don', 'donController@index')->name('don');
    Route::get('/dons', 'donController@historyDonation')->name('donhist');
    Route::post('/don', 'donController@prepaiement')->name('don.post');
    Route::post('/donb', 'donController@paiement')->name('don.post2');
    
    Route::get('subscrdel','SubscriptionController@delete')->name('subscr.delete');
    Route::get('show','SubscriptionController@show')->name('subscr.manage');
    Route::post('/subscription', 'SubscriptionController@create')->name('subscription.create');
    Route::get('stripe/users','SubscriptionController@index')->name('subscr.index');
    Route::get('subscr/list','SubscriptionController@subscriptionList')->name('subscr.subscrList');
    
    Route::view('xplan','plans/index')->name('plans.index');
    Route::get('/plan/{plan}', 'PlanController@show')->name('plans.process');
    Route::view('createplan','plans/create')->name('plans.create');
    Route::get('planpr/{product}','PlanController@createProduct')->name('plans.createProd');
    Route::post('planpl','PlanController@createPlan')->name('plans.createPlan');
    Route::get('plan', 'PlanController@index')->name('plans.show');

    Route::get('addmember', 'InvitationController@addmember')->name('invit.addmember');
    Route::post('mailtomember', 'InvitationController@mailtomember')->name('invit.mailtomember');
    Route::get('inv/{uid}','InvitationController@store');

    Route::get('visitors', 'VisitorsController@index')->name('visitors');
});

Route::middleware('visitors')->group(function(){
    Route::view('nogroup','visitors.nogroup')->name('nogroup');
    // Route::get('groupe/{slug}', 'SongController@indexByVisitors');
    // Route::get(config('app.visitors_urlslugprefix').'/{slug}', 'SongController@indexByVisitors');
    Route::group(['prefix' => config('app.visitors_urlslugprefix')], function () {
        Route::get('/{slug}', 'SongController@indexByVisitors');
    });
});
Route::view('medias', 'visitors.medias')->name('visitors.medias');
Route::get('showband/{slug}', 'BandController@showByVisitors')->name('visitors.showband');


Auth::routes();

Route::view('/','auth/login')->name('accueil');
Route::get('language/{lang}', 'HomeController@language')->name('language');
Route::get('/songs/pdf', 'SongController@printPlaylist');
Route::view('/ML', 'mentionslegales');
Route::view('/CF', 'confidentialite');
Route::view('/CGV', 'cgv');
Route::view('hlp', 'help');

Route::post('song-sortable','SongController@update_order')->name('orderingPlaylist');
Route::resource('songs', 'SongController');

Route::get('playlist/{list}', 'SongController@index')->name('playlist');

Route::get('dwnld/{songsub}', 'SongsubController@download')->name('songsub.dwnld');
Route::get('songsub/{sub?}', 'SongsubController@create')->name('songsub.create');
// Route::get('songsub/{song}/edit', 'SongsubController@edit')->middleware('members');
Route::resource('songsub', 'SongsubController')->except(['create']);

Route::get('contactez-nous', 'ContactController@create')->name('contact.create');
Route::post('contactez-nous', 'ContactController@store')->name('contact.store');


Route::get('songsband/{id}', function($id){  //coming from band/show.blade.php (admin area)
    session(['band_id' => $id]);
    return redirect('songs');
})->name('band.songs');

Route::get('play/{songsub}', function(Songsub $songsub){
    session(['filetoplay' => $songsub]);
    return redirect('songs');
})->name('player');

Route::get('playin/{songsub}/{id}', function(Songsub $songsub, $id){
    session(['filetoplay' => $songsub]);
    return redirect('songs/' . $id);
})->name('playin');

Route::get('users/{slug}/{sort}', 'UserController@indexByAdmin')->middleware('admin')->name('user.indexByAdmin');
Route::get('users/{slug}', 'UserController@indexByAdmin')->middleware('admin')->name('user.band');
Route::get('band/del','BandController@delete')->name('band.delete');
Route::get('band/{band}', 'BandController@showByAdmin')->name('bandByAdmin');
Route::get('Myband', 'BandController@show')->name('band.show'); //method show sans paramètre
Route::get('bandsorted/{sort}', 'BandController@index')->name('band.index');
Route::resource('band', 'BandController')->except(['show','index']);//except show car pas besoin de paramètre pour cette méthode, non CRUD

Route::resource('medias', 'MediaController');




//TEST
use App\Song;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Markdown;
use Illuminate\Mail\Mailable;
use App\Mail\InvitMail;

Route::get('songnotifmail', function () {
    $users = Auth::user()->band->users;
    $song = Song::find(1);

    return (new App\Notifications\SongNotif($song))
                ->toMail($users);
});

Route::get('newusermail', function () {
    $user = Auth::user();
    return (new App\Notifications\NewUser($user))
                ->toMail($user);
});
//FIN TEST


// Route::get('ville', 'VilleController@index')->name('ville.index')->middleware('admin');

/* Route::get('bandtest', function(){
    $band = App\Band::find(3);
    dd($band->ville);
}); */

// Route::get('register-step2', 'Auth\RegisterStep2Controller@showForm');
// Route::post('register-step2', 'Auth\RegisterStep2Controller@postForm')->name('register.step2');