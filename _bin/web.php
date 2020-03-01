<?php

//sauvegarde du 22/02 avant la réordonnance des routes (juste l'ordre)
Auth::routes();
Route::resource('profil', 'ProfilController');
Route::get('profil','ProfilController@index')->name('profil');

Route::name('language')->get('language/{lang}', 'HomeController@language');

Route::post('song-sortable','SongController@update_order')->name('orderingPlaylist');

//attention ordre important
Route::resource('songs', 'SongController');

Route::get('songsband/{id}', function($id){  //coming from band/show.blade.php (admin area)
        session(['band_id' => $id]);
        return redirect('songs');
    })->name('band.songs');


Route::get('playlist/{list}', 'SongController@index')->name('playlist')->middleware('admin');

Route::view('/','welcome')->name('accueil');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('contactez-nous', 'ContactController@create')->name('contact.create');
Route::post('contactez-nous', 'ContactController@store')->name('contact.store');


Route::resource('user', 'UserController')->middleware('admin');
// Route::get('user/{id}', 'UserController@show')->middleware('admin');
Route::get('users', 'UserController@index')->middleware('admin')->name('user.index');
Route::get('banduser/{slug}', 'UserController@index')->name('user.band');

//attention ordre important
Route::resource('band', 'BandController')->middleware('admin');
Route::get('band/{slug}', 'BandController@show')->name('band.show');



Route::get('ville', 'VilleController@index')->middleware('admin')->name('ville.index');

Route::get('bandtest', function(){
    $band = App\Band::find(3);
    dd($band->ville);
});



