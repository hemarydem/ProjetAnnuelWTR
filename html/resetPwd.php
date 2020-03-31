<?php
  session_start();
  require('includes/config.php');

  if( !isset($_GET['login']) || !isset($_GET['token']) ){

    header('location: error.html');
    exit;

  }else {

  $loginGET = $_GET['login'];
  $tokenGET = $_GET['token'];

  $q = 'SELECT token FROM USER WHERE login = ?';
  $req = $bdd->prepare($q);
  $req->execute([$loginGET]);
  $tokenBDD = $req->fetch();

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      include('includes/head.php');
    ?>
  </head>
  <body>
    <?php
    include('includes/header.php');
    ?>
    <main>
      <?php
      if(count($tokenBDD) > 0 && $tokenGET ==  $tokenBDD[0]) {

      echo '<form method="post" action=" restPwdValidator.php?login=' . $loginGET . '">
      <label>Mot de passe</label>
            <input type="password" name="password" placeholder="1 majuscule 1 chiffre et 1 caractère spécial" autocomplete="on" required>
            <label>Confirmation</label>
            <input type="password" name="password1" placeholder="1 majuscule 1 chiffre et 1 caractère spécial" autocomplete="on" required>
            <input type="submit" name"submit" value="Changer de mot de passe"></input>
            </form>';
      } else {
        header('location: error.html');
        exit;
      }
    ?>
    </main>
  </body>
</html>
