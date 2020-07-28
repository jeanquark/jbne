@component('mail::message')

<h2 style="text-align: center;">Notification d'erreur</h2>

Nouvelle erreur. Les données transmises sont les suivantes:
<br /><br />

{{ $exception->getMessage() }}

<br /><br />
Message envoyé depuis le site www.jbne.ch
@endcomponent
