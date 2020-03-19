<?php

session_start();
require('../../includes/config.php');


if( !isset($_GET['login']) || !isset($_GET['token']) ){

  header('location: https://thomerlas.online/pages/error.html');
  exit;

}else{
  $loginGET = $_GET['login'];
  $tokenGET = $_GET['token'];

  $q = 'SELECT token FROM USERS WHERE login = ?';
  $req = $bdd->prepare($q);
  $req->execute([$loginGET]);
  $tokenBDD = $req->fetch();



  if(count($tokenBDD) > 0 && $tokenGET ==  $tokenBDD[0]){

    $q = 'UPDATE USERS SET working = 1 WHERE login = ?';
    $req = $bdd->prepare($q);
    $req->execute([$loginGET]);
    header('location: https://thomerlas.online/sign/signIn/signIn.php?msg=Votre compte est maintenant actif');
    exit;
    echo 'OK';

  }else{
    header('location: https://thomerlas.online/pages/error.html');
    exit;
  }
}
?>
