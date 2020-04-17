
<a href="javascript:history.back()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')</a>

<a class="navbar-brand" href="">Mentions légales</a>
            <a class="navbar-brand" href="">Politique de confidentialité</a>


Route::get('users', 'UserController@indexByAdmin')->middleware('admin')->name('user.indexByAdmin');
Route::get('deleteImage/{user}', 'UserController@deleteImage')->name('user.deleteImage');
Route::get('user/{user}', 'UserController@show')->name('user.show');
Route::get('user/{user}/edit', 'UserController@edit')->name('user.edit');
Route::patch('user/{user}', 'UserController@update')->name('user.update');
Route::get('user', 'UserController@index')->name('user.index');
Route::delete('user/{user}', 'UserController@destroy')->name('user.destroy');


<!-- <small><a href="{{ action('UserController@destroy', ['user' => $user->id]) }}">supprimer</a></small>  -->
<!-- <form action="{{ route('user.destroy', ['user' => $user->id])  }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Supprimer</button>
</form>                   -->

