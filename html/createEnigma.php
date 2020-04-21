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
      <form name="creatEnigmaForm" onsubmit="return check()"  action="createEnigmaValidator.php" method="post" enctype="multipart/form-data" >
        <div class="createEnigma flex">
          <div>
            <div id="titleContainer">
              <input type="text" name="title" placeholder="Titre*">
            </div>
            <div id="descriptionContainer">
              <input type="text" name="description" placeholder="Description*">
            </div>
            <div id="questionContainer">
              <input type="text" name="question" placeholder="Question*">
            </div>
            <div id="trueAnswerContainer">
              <input type="text" name="trueAnswer" placeholder="Vraie réponse*">
            </div>


            <select name="level" id="level">
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
          <div>
            <div id="falseAnswersContainer">
                <input type="text" class="falseAnswer" name="falseAnswer" id="falseAnswer0" placeholder="Fausse réponse*">
            </div>
            <input type="button" value="Ajouter d'autres fausses réponces"  onclick="addInput()">
            <div id="trickContainer">

            </div>
            <input type="text" name="trick" placeholder="Indice">

            <img src="img/enigma/defaultPicture.png" alt="Img_Enigma">
            <label for="imageEnigma">Choisir une image</label>
            <input id="imageEnigma" type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/gif"  style="display: none">


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
    <script src="script/creatEnigma.js"></script>
  </body>
</html>
