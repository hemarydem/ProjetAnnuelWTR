<?php
    require('includes/config.php');
    session_start();
if(isset($_POST['mail']) && !empty($_POST['mail'])) {
     
    $mail = trim($_POST['email']);
    
//________check if the mail own an accoiunt__________//

    $q = 'SELECT email, login FROM users WHERE email = ?';
    $request = $bdd->prepare($q);
    $request->execute([$mail]);
    $result = $request->fetch(PDO::FETCH_ASSOC);
    
    if($result['email'] != 0) {
        $mail = $result['email'];
        $login = $result['login'];

//________deactivation__________//

        $q = 'UPDATE USERS SET working = 0 where email = :mail';
        $req = $bdd->prepare($q);
        $req->execute(['mail' => $mail]);

//__________Reset the token__________//
        $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $q = 'INSERT INTO USERS (token) VALUES (:token)';
	    $req = $bdd->prepare($q);
        $req->execute(['token' => $token]);
        
//__________New mail__________//
        $to = $mail;
        $from = 'Thomerlas';
        $name = 'Thomerlas';
        $subject = 'initialisation mot de passe';
        $link = 'https://thomerlas.online/accountValidator.php?login=' . $login . '&token=' . $token;
        $message = '<a href="' . $link . '"> Clickez sur ce lien pour initialiser un nouveau mot de passe </a>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= 'From: ' . $from. ' <' . $name . '>';
        mail( $to, $subject, $message, $headers );
    } else {
        header('location: signin.php?msg=Ce mail ne correspond n\'pas de compte');
        exit;
    }
}
?>
