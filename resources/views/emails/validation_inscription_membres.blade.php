@component('mail::message')

<h2 style="text-align: center;">Validation de votre inscription</h2>

<strong>Bienvenue!</strong><br /><br />
Nous avons le plaisir de vous informer que votre inscription en tant que membre du Jeune Barreau neuchâtelois a été validée. Vous avez désormais accès à nos <a href="{{ env('APP_URL') }}/fichiers-en-partage" target="_blank"> fichiers en partage</a>. <br />

Les données que nous avons en notre possession vous concernant sont les suivantes:

@component('mail::table')
| Champ         | Valeur                     |
| ------------- |----------------------------| 
| Nom           | {{ $member['lastname'] }}    |
| Prénom        | {{ $member['firstname'] }}   |
| Email         | {{ $member['email'] }}       |
| Rue et numéro | {{ $member['rue'] }}       	 |
| Code postal et localité | {{ $member['localite'] }} |
@endcomponent

Message envoyé depuis le site <a href="https//www.jbne.ch" target="_blank">www.jbne.ch</a>
@endcomponent