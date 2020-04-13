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
        <div class="createEnigma flex">
          <div>
            <div id=titleContainer>
              <input type="text" id="title" placeholder="Titre">
            </div>
            <div id=descriptionContainer>
              <input type="text" id="description" placeholder="Description">
            </div>
            <div id="questionContainer">
              <input type="text" id="question" placeholder="Question">
            </div>
            <div id="trueAnswerContainer">
              <input type="text" id="trueAnswer" placeholder="Vraie réponse">
            </div>
            
            
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
          <div>
            <div id="falseAnswersContainer">
                <input type="text" id="falseAnswer0" placeholder="Fausse réponse">
            </div>
            <input type="button" value="Ajouter d'autres fausses réponces"  onclick="addinput()">

            <input type="text" name="trick" placeholder="Indice">
            <img src="img/enigma/defaultPicture.png" alt="Img_Enigma">
            <label for="imageEnigma">Choisir une image</label>
            <input id="imageEnigma" type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/gif"  style="display: none">
              
          </div>
        </div>
        <div class="">
          <input type="button" name="submit" value="Créer" onclick="check()">
        </div>

    </main>
    <footer>
      <?php include('includes/footer.php') ?>
    </footer>
    <input type="hidden" id="custId" name="custId" value="1">
    <script src="script/creatEnigma.js"></script>
  </body>
</html>
