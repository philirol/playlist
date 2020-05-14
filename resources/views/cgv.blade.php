@extends( session('visitors') == 1 ? 'layouts.appvisitors' : 'layouts.app' )

@section('content')

<x-flag-page position="left" type="{{ session('visitors') == 1 ? config('app.visitorflagcolor') : config('app.appflagcolor') }}" page="Conditions Générales de Vente" margbot="3"/>

<h3>Préambule</h3>
<p>Les présentes conditions générales de vente sont définies entre l'éditeur du site Playlist: Védas Informatique, représenté par Philippe Roland, sous le statut de micro-entrepreneur - SIRET 849 500 012 00018, et dénommé par "l'Éditeur" ci-dessous par mesure de simplification et l'Utilisateur (personne physique ou morale qui réalise une transaction financière sur le site Playlist).<br>
"Playlist" étant identifié par le site internet accessible à l'adresse : https://playlistband.net</p>

<h3>Généralités</h3>
<p>L'Éditeur propose sur Playlist les systèmes de don et d'abonnement entre l'Utilisateur et Védas Informatique, via la solution de paiement <a href="https://stripe.com/fr/" target="_blank">Stripe</a>.
</p>

<h3>Utilisation du site</h3>
<p>L'utilisateur s'engage à ne pas utiliser le site à des fins illicites ou commerciales.</p>
<p>Les services payants sur Playlist sont :
<ul>
    <li>Le don, qui représente un soutien financier en contrepartie du service rendu,</li>
    <li>Les formules d'abonnement, proposant des volumes de stockage des fichiers.</li>
</ul>
<p>Tous les membres du groupe peuvent souscrire un abonnement pour le compte du groupe.<br>
Si l'utilisateur est supprimé, son abonnement le sera aussi. Le groupe ne pourra plus bénéficicier de cet abonnement.<br>
Un Utilisateur ne peut être supprimé que par son leader.<br>
</p>

<h3>Prix des abonnements</h3>
<p>Playlist se réserve le droit de modifier les prix des abonnements et des volumes de stockage par formule. L'abonnement annuel en vigueur ne sera pas affecté par ce changement.<br>
La mise à jour du volume de stockage est immédiat après l'abonnement.<br>
En cas de suppression d'un abonnement, celui-ci est dû pour le restant de l'année.<br>
Le renouvellement des abonnements est reconductible tacitement. L'abonné peut supprimer son abonnement sur le site directement ou en envoyant sa demande à vedas@informatique.fr.<br>
</p>
<h3>Preuve de transaction</h3>
<p>Le paiement en ligne par carte bancaire est réalisé par l’intermédiaire de la société <a href="https://stripe.com/fr/" target="_blank">Stripe.com</a>.
<br>
Les données enregistrées par le système de paiement Stripe constituent la preuve des transactions financières réalisées par le ou les moyens de paiement de l'abonné.
</p>

<h3>Facturation</h3>
<p>Dés que le l'Utilisateur a souscrit un don ou un abonnement, une facture lui est envoyé sous 24h</p>


@endsection