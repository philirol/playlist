@component('mail::message')
# Message du site {{ config('app.name') }}, le site de gestion de playlist.

Vous recevez l'invitation de {{ $data['leader'] }} à rejoindre le groupe "{{ $data['bandname'] }}".

**Message de {{ $data['leader'] }}:**
{{ $data['message'] }}

Merci de cliquez sur le bouton ci-dessous pour accepter l'invitation.

@component('mail::button', ['url' => $data['url']])
Acceptez l'invitation
@endcomponent

Merci,<br>
Le site {{ config('app.name') }}
@endcomponent
