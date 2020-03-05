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
Route::get('users', 'UserController@index')->middleware('admin')->name('user.index');
Route::get('banduser/{slug}', 'UserController@index')->middleware('admin')->name('user.band');
Route::resource('user', 'UserController')->middleware('admin');

Route::get('songsband/{id}', function($id){  //coming from band/show.blade.php (admin area)
    session(['band_id' => $id]);
    return redirect('songs');
})->name('band.songs');

Route::resource('band', 'BandController');

Route::resource('profil', 'ProfilController');
Route::get('newprofil', 'ProfilController@newUser')->name('newprofil');
Route::get('geog/{slug}', 'ProfilController@geog')->name('user.ville');



Route::get('ville', 'VilleController@index')->name('ville.index')->middleware('admin');

Route::get('bandtest', function(){
    $band = App\Band::find(3);
    dd($band->ville);
});

Route::get('register-step2', 'Auth\RegisterStep2Controller@showForm');
Route::post('register-step2', 'Auth\RegisterStep2Controller@postForm')->name('register.step2');



