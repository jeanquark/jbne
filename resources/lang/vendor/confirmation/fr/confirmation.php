<?php

return [
    'email-title' => 'Vérification d\'email',
    'email-intro' => 'Pour valider votre email cliquez sur le bouton ci-dessous',
    'email-button' => 'Confirmation d\'email',
    'message' => 'Merci pour votre enregistrement ! Nous allons vous envoyer un e-mail de confirmation à l\'adresse que vous nous avez transmise dans le formulaire. Veuillez ouvrir cet e-mail et cliquer sur le bouton "Confirmation d\'email". Vous pourrez ensuite vous connecter.',
    'success' => 'Votre compte est désormais confirmé! Vous pouvez vous connecter.',
    'again' => 'Vous devez valider votre email avant de pouvoir accéder à ce site. ' .
                '<br>Si vous n\'avez pas reçu l\'email de confirmation veuillez consulter votre dossier de spams.' .
                '<br>Pour recevoir à nouveau un email de confirmation <a href="' . url('confirmation/resend') . '" class="alert-link">cliquez ici</a>.',
    'resend' => 'Un email de confirmation va vous être envoyé. Veuillez consulter vos emails en réception.'
];
