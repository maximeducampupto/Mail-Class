<?php

require '../classes/Mail.php';

$mail = new Mail('simon@stien.fr', 'Just a mail', 'Because why not');

$mail->addTo('sebastien@dumont.fr'); // Adds a new mail recipient to current list
$mail->setTo('charlotte@lienard.fr'); // Clears current recipient to replace them with a new one

print_r($mail->getTo()); // "charlotte@lienard.fr"

$mail->send(); // Using plain text

$mail->template()->send(); // Using HTML template

