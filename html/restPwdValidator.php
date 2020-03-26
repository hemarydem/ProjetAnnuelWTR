<?php
     include('includes/config.php');

     echo $_GET['login'];
     $q = 'UPDATE USERS SET pass = ? WHERE login = ? ';
     $req = $bdd->prepare($q);
     $req->execute([$_POST['password'],$_GET['login']]);
     header('location:signIn.php?msg=Votre compte est maintenant actif');
     //exit;

?>