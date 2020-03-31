<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Songsub;

Route::view('/','auth/login')->name('accueil');
Route::view('abon','band/proposAbon')->name('proposAbon');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('language/{lang}', 'HomeController@language')->name('language');
Route::get('/songs/pdf', 'SongController@printPlaylist');

Route::post('song-sortable','SongController@update_order')->name('orderingPlaylist');
Route::resource('songs', 'SongController');
Route::get('playlist/{list}', 'SongController@index')->name('playlist');

Route::get('dwnld/{songsub}', 'SongsubController@download')->name('songsub.dwnld');
Route::get('songsub/{sub?}', 'SongsubController@create')->name('songsub.create');
Route::resource('songsub', 'SongsubController')->except(['create']);

Route::get('contactez-nous', 'ContactController@create')->name('contact.create');
Route::post('contactez-nous', 'ContactController@store')->name('contact.store');

Auth::routes();
Route::get('users', 'UserController@indexByAdmin')->middleware('admin')->name('user.indexByAdmin');
Route::get('banduser/{slug}', 'UserController@indexByAdmin')->middleware('admin')->name('user.band');
Route::get('usershow', 'UserController@show')->name('user.show');
Route::get('deleteImage/{user}', 'UserController@deleteImage')->name('user.deleteImage');
Route::resource('user', 'UserController');

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

Route::get('band/{band}', 'BandController@showByAdmin')->middleware('admin')->name('bandByAdmin');
Route::get('Uband', 'BandController@show')->name('band.show'); //method show sans paramètre
Route::resource('band', 'BandController', ['except' => ['show']]);

// Route::get('ville', 'VilleController@index')->name('ville.index')->middleware('admin');

Route::get('bandtest', function(){
    $band = App\Band::find(3);
    dd($band->ville);
});

// Route::get('register-step2', 'Auth\RegisterStep2Controller@showForm');
// Route::post('register-step2', 'Auth\RegisterStep2Controller@postForm')->name('register.step2');



