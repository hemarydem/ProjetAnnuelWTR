<?php
  session_start();
  require('includes/config.php');

  if( !isset( $_SESSION['pseudo'] ) ){
    header('Location: signIn.php');
    exit;
  }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <?php include('includes/head.php') ?>
  </head>
  <body>
      <?php include('includes/header.php') ?>
    <main>
      <h1>Créer une énigme</h1>
      <?php echo isset( $_GET['msg'] ) ? $_GET['msg'] : ""; ?>
      <form class="flexColumn" action="enigmaValidator.php" method="post" enctype="multipart/form-data">
        <div class="createEnigma flex">
          <div class="">
            <input type="text" name="title" placeholder="Titre">
            <input type="text" name="description" placeholder="Description">
            <input type="text" name="question" placeholder="Question">
            <input type="text" name="answer" placeholder="Réponse">
            <select name="level">
              <?php
                //select the levels
                $q = 'SELECT name FROM LEVEL';
                $req = $bdd->query($q);
                $result = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $key => $value){
                  echo ' <option>' . $value['name'] . '</option>';
                }

              ?>
            </select>
          </div>
          <div class="">
            <input type="text" name="trick" placeholder="Indice">
            <img src="img/enigma/defaultPicture.png" alt="Img_Enigma">
            <label for="imageEnigma">Choisir une image</label>
            <input id="imageEnigma" type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/gif"  style="display: none">
            <div class="time">
              <input type="number" name="minutes" placeholder="05">
              <input type="number" name="seconds" placeholder="00">
            </div>

          </div>
        </div>
        <div class="">
          <input type="submit" name="submit" value="Créer">
        </div>


      </form>
    </main>
    <footer>
      <?php include('includes/footer.php') ?>
    </footer>
  </body>
</html>
