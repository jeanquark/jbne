@component('mail::message')

<h2 style="text-align: center;">Formulaire de contact</h2>

Nouvelle prise de contact. Les données transmises sont les suivantes:

@component('mail::table')

<p><b>Nom:</b> {{ $data['nom'] }}</p>
<p><b>Prénom:</b> {{ $data['prenom'] }}</p>
<p><b>Email:</b> {{ $data['email'] }}</p>
<p><b>Message:</b> {{ $data['message'] }}</p>

@endcomponent

@component('mail::button', ['url' => 'www.jbne.ch/back/formulaire-contacts'])
	Consulter en ligne
@endcomponent

Message envoyé depuis le site www.jbne.ch
@endcomponent
