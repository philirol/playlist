@component('mail::message')
# Envoi d'erreur depuis le site Playlist

**Fichier :**
{{ $data['file'] }}

**Code :**
{{ $data['code'] }}

**Ligne :**
{{ $data['line'] }}

**Message :**
{{ $data['message'] }}

**Trace format :**
*{{ $data['traceAsString'] }}*

@component('mail::button', ['url' => 'https://playlistband.net'])
Aller sur le site
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
