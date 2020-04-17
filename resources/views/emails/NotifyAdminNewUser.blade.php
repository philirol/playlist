@component('mail::message')

#Un utilisateur s'est inscrit sur le site Playlist :

Nom : {{ $user->name }}

Groupe : {{ $user->band->bandname }}

Email : {{  $user->email }}

Date : {{ $user->created_at }}

Leader : {{ $user->leader }}

@component('mail::button', ['url' => 'https://playlistband.net'])
Go on Playlist
@endcomponent

@endcomponent
