<?php
    require('includes/config.php');
    session_start();
if(isset($_POST['login']) && !empty($_POST['login'])) {
     
    $login = trim($_POST['login']);
    
//________check if the login own an account__________//

    $q = 'SELECT email, login FROM users WHERE login = ?';
    $request = $bdd->prepare($q);
    $request->execute([$login]);
    $result = $request->fetch(PDO::FETCH_ASSOC);
    if( count($result) > 0) {
        $mail = $result['email'];
        $login = $result['login'];

//__________Reset the token__________//
        $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $q ='UPDATE USERS SET token= :token WHERE email= :mail';
	    $req = $bdd->prepare($q);
        $req->execute(['token' => $token, 'mail' => $mail]);
      
        
//__________New mail__________//
        $to = $mail;
        $from = 'Thomerlas';
        $name = 'Thomerlas';
        $subject = 'initialisation mot de passe';
        $link = 'https://thomerlas.online/restPwd.php?login=' . $login . '&token=' . $token;
        $message = '<a href="' . $link . '"> Clickez sur ce lien pour initialiser un nouveau mot de passe </a>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= 'From: ' . $from. ' <' . $name . '>';
        mail( $to, $subject, $message, $headers );

        header('Location:forgotPwd.php');

    } else {
        header('location: signin.php?msg=Ce pseudo ne correspond à aucun compte');
    }
}
?>
