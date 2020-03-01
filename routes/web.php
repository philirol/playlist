<?php

Route::view('/','welcome')->name('accueil');
Route::get('/home', 'HomeController@index')->name('home');
Route::name('language')->get('language/{lang}', 'HomeController@language');


Route::post('song-sortable','SongController@update_order')->name('orderingPlaylist');
Route::resource('songs', 'SongController');
Route::get('playlist/{list}', 'SongController@index')->name('playlist');

Route::get('contactez-nous', 'ContactController@create')->name('contact.create');
Route::post('contactez-nous', 'ContactController@store')->name('contact.store');

Auth::routes();
Route::get('users', 'UserController@index')->name('user.index')->middleware('admin');
Route::get('banduser/{slug}', 'UserController@index')->name('user.band');
Route::resource('user', 'UserController')->middleware('admin');

Route::get('songsband/{id}', function($id){  //coming from band/show.blade.php (admin area)
    session(['band_id' => $id]);
    return redirect('songs');
})->name('band.songs');

Route::resource('band', 'BandController')->middleware('admin');

Route::resource('profil', 'ProfilController');
Route::get('newprofil', 'ProfilController@newUser')->name('newprofil');
Route::get('geog/{slug}', 'ProfilController@geog')->name('user.ville');



Route::get('ville', 'VilleController@index')->name('ville.index')->middleware('admin');

Route::get('bandtest', function(){
    $band = App\Band::find(3);
    dd($band->ville);
});



