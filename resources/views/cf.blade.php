@extends( $book == 'app' ? 'layouts.app' : 'layouts.appvisitors' )

@section('content')
<x-flag-page position="left" type="{{ $book == 'visit' ? config('app.visitorflagcolor') : config('app.appflagcolor') }}" page="Politique de confidentialité" margbot="3"/>

<p>Le principe de confidentialité s'applique sur toute donnée personnelle transmise par les utilisateurs via le site Playlist.<br>
 S'entend par "utilisateur" toute personne physique ou morale identifiable par les données personnelles qu'elle transmet.</p>

<p>S'entend par donnée personnelle toute donnée directe, comme le nom de l'utilisateur, et indirecte, comme le courriel et les fichiers transmis, fichiers audios, vidéo, images, etc.</p>

<h3>Utilisation des données personnelles</h3>
<p>Toutes les données transmises au site Playlist sont protégées et traitées de manière conforme à la réglementation en vigueur (<a href="https://www.cnil.fr/fr/comprendre-le-rgpd" target="_blank">RGPD</a>).</p>

<p>Le traitement de ces données comprend la collecte et l'extraction pour l'affichage, la communication par transmission et le diffusion, exclusivement aux personnes constituant le groupe auquel appartient l'utilisateur, le terme "groupe" étant défini au sens du terme exploité par le site Playlist.</p>

<p>La collecte des données personnelles sont également utilisées pour le fonctionnement du site, à savoir la navigation, la création et la modification des comptes propres à chaque utilisateur, les services de paiement et les demandes de renseignement par le formulaire de contact.</p>

<p>Un paiement effectué sur le site par un utilisateur implique la transmission de son courriel et les informations données pour son moyen de paiement à notre partenaire <a href="https://stripe.com" target="_blank">Stripe</a>.
<span class="note">Voir plus de détails sur les transactions financières dans les <a href="{{ URL::to('/CGV') }}">CGV</a>.</span><br>
</p>

<h3>Modification des données personnelles</h3>
<p>La modification des données personnelles de chaque utilisateur lui est exclusive, les autres membres du groupe ne pourront pas les modifier, à l'exception des fichiers transmis pour constituer la playlist du groupe, où chaque membre a la possibilité de les télécharger et les exécuter en lecture.<br> 
L'éditeur du site Playlist se dégage de toute responsabilité en cas de modification ou d'appropriation des fichiers après téléchargement par les autres membres du groupe.</p>

<h3>Conservation des données personnelles</h3>
Les données personnelles de l'utilisateur sont conservées jusqu'à sa suppression, effectuée sur le site par lui-même ou par l'action de son leader par la suppression du groupe.
<br>
Des éléments de facturation pourront être conservées si l'utilisateur a effectué une transation financière, conformément à l'article 123-22 du code du commerce.
<br>
Les données bancaires utilisées par l'utilisateur au moment de son abonnement sont enregistrées et conservées uniquement par Stripe, pour le renouvellement annuel de la souscription.
</p>

<h3>Droit d'accès aux données personnelles</h3>
<p>Conformément à la loi 78-17 du 6 janvier 1978, connue sous le nom de loi informatique et libertés, l'utilisateur a le droit d'accès, de rectification et de suppression de ses données stockées.<br>
Outre les services du site Playlist lui pemettant de le faire, l'utilisateur peut également exercer ce droit en faisant une demande explicite à l'adresse suivante : vedasinformatique@gmail.com.
</p>

<h3>Utilisation des cookies</h3>
<p>Le site Playlist utilise des "cookies". L'utilisateur a le choix de les accepter ou non.<br>
Le site Playlist les utilisera uniquement à des fins statistiques de fréquentation.
</p><br>

@endsection