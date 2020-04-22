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
            <div id="trickContainer">
                <input type="text" name="trick" placeholder="Indice">
            </div>
            

            
            <div id="0" onclick="selectDiv(0)" >
                <p>Choisir une image pour A0</p>
                <input id="imageEnigma" type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/gif" >          
            </div>

            <div id="1" onclick="selectDiv(1)">
                <p>Choisir une image pour A1</p>
                <input id="imageEnigma1" type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/gif" >
            </div >
            <div id="2" onclick="selectDiv(2)">
                <p>Choisir une image pour A2</p>
                <input id="imageEnigma2" type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/gif" >
            </div >
            <div id="3" onclick="selectDiv(3)">
                <p>Choisir une image pour A3</p>
                <input id="imageEnigma3" type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/gif" >
            </div >
            <div id="4" onclick="selectDiv(4)">
                <p>Choisir une image pour A4</p>
                <input id="imageEnigma4" type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/gif" >
            </div >
            <div id="5" onclick="selectDiv(5)">
                <p>Choisir une image pour A5</p>
                <input id="imageEnigma5" type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/gif" >
            </div >
            <div id="6" onclick="selectDiv(6)">
                <p>Choisir une image pour A6</p>
                <input id="imageEnigma6" type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/gif" >
            </div >
            <div id="7" onclick="selectDiv(7)">
                <p for="imageEnigma7">Choisir une image pour A7</p>
                <input id="imageEnigma7" type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/gif" >
          </div>
        </div>
        <div class="">
          <input type="submit" name="submit" value="Créer">
        </div>

        <input name="strAnswers" type="hidden">

      </form>
    </main>
    <footer>
      <?php include('includes/footer.php') ?>
    </footer>
    <script src="script/createEnigmaImg.js"></script>
  </body>
</html>
