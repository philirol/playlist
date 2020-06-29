<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\{Songsub,Band};

Auth::routes(['verify' => true]);

// Route::fallback(function(){
//     return view('errors/fallback');
// });

Route::middleware('members')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::get('SubscribedPlan','SongsubController@showPlan');
    Route::get('/list/files', 'BandController@storedfilelist')->name('storedfilelist');
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
    
});
Route::get('inv/{uid}','InvitationController@store');

Route::post('contact/{id}', 'ContactController@mailtoLeader')->name('contact.store');
Route::get('contact', 'ContactController@create')->name('contact.create');

Route::get('book', 'BookController@geturl')->name('visitors');

Route::post('book/contact/{id}', 'ContactController@mailtoLeader')->name('book.contact');
Route::get('book/contact', 'BookController@contact')->name('book.contact');

Route::get('book/story', 'BookController@story')->name('book.story');
Route::get('book/videos', 'BookController@videos')->name('book.videos');
Route::get('book/photos', 'BookController@photos')->name('book.photos');
Route::get('book/band', 'BookController@band')->name('book.band');
Route::get('book/playlist', 'BookController@playlist')->name('book.playlist');

Route::get('playbook/{songsub}/{id}', function(Songsub $songsub, $id){
    session(['filetoplaybook' => $songsub]);
    return redirect()->action('BookController@playlist',$id);
})->name('playerVisitor');

Route::middleware('visitors')->group(function(){
    Route::view('nogroup','book.nogroup')->name('nogroup');
    Route::group(['prefix' => config('app.visitors_urlslugprefix')], function () {
        Route::get('/{slug}', 'BookController@index');
    });
});

Route::resource('photos', 'PhotoController');
Route::resource('videos', 'VideoController');
Route::resource('story', 'StoryController');


Route::view('/','auth/login')->name('accueil');
Route::get('language/{lang}', 'HomeController@language')->name('language');
Route::get('/songs/pdf', 'SongController@printPlaylist');

Route::get('cgv/{book?}', function($book){ return view('cgv', compact('book')); })->name('cgv');
Route::get('cf/{book?}', function($book){ return view('cf', compact('book')); })->name('cf');
Route::get('ml/{book?}', function($book){ return view('ml', compact('book')); })->name('ml');
Route::post('sendtowbm', 'ContactController@mailtoAdmin')->name('contact.store');
Route::get('contactwbm/{book?}', function($book){ return view('contact.admin', compact('book')); })->name('contactwbm');

Route::view('hlp', 'help');

Route::post('song-sortable','SongController@update_order')->name('orderingPlaylist');
Route::resource('songs', 'SongController');

Route::get('playlist/{list}', 'SongController@index')->name('playlist');

Route::get('dwnld/{songsub}', 'SongsubController@download')->name('songsub.dwnld');
Route::get('songsub/{sub?}', 'SongsubController@create')->name('songsub.create');
// Route::get('songsub/{song}/edit', 'SongsubController@edit')->middleware('members');
Route::resource('songsub', 'SongsubController')->except(['create']);

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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('send-mail', 'HomeController@sendMail');
