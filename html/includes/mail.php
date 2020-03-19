<?php
$to = $email;
$from = 'Thomerlas';
$name = 'Thomerlas';
$subject = 'Prêt à résoudre des énigmes ?';
$link = 'https://thomerlas.online/sign/signUp/accountValidator.php?login=' . $login . '&token=' . $token;
$message = '<a href="' . $link . '"> Clickez sur ce lien pour valider votre inscription </a>';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
$headers .= 'From: ' . $from. ' <' . $name . '>';
mail( $to, $subject, $message, $headers );
?>
