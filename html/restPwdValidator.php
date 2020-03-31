<?php
     include('includes/config.php');

     $newPassword = $_POST['password'];
     $newPassword = hash('sha256', $newPassword ); 

     echo $_GET['login'];
     $q = 'UPDATE USER SET pass = ? WHERE login = ? ';
     $req = $bdd->prepare($q);
     $req->execute([$newPassword,$_GET['login']]);
     header('location:signIn.php?msg=Votre compte est maintenant actif');
     exit;
?>