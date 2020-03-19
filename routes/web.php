<?php

Route::view('/','auth/login')->name('accueil');
Route::get('/home', 'HomeController@index')->name('home');
Route::name('language')->get('language/{lang}', 'HomeController@language');


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

Route::resource('band', 'BandController');
Route::get('banduser', 'BandController@showBandUser')->middleware('auth')->name('banduser');;


Route::get('newprofil', 'ProfilController@newUser')->name('newprofil');
Route::get('geog/{slug}', 'ProfilController@geog')->name('user.ville');

Route::get('ville', 'VilleController@index')->name('ville.index')->middleware('admin');

Route::get('bandtest', function(){
    $band = App\Band::find(3);
    dd($band->ville);
});

// Route::get('register-step2', 'Auth\RegisterStep2Controller@showForm');
// Route::post('register-step2', 'Auth\RegisterStep2Controller@postForm')->name('register.step2');



