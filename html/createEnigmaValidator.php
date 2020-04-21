<?php
session_start();
require('includes/config.php');

//The player is connected
if( !isset( $_SESSION['pseudo'] ) ){
  echo '0';
  return;
}
$pseudo = $_SESSION['pseudo'];

//trim the inputs
foreach ($_POST as $key => $value) {
  $_POST[$key] = trim( $_POST[$key] );
}


// Check the inputs
if( !isset( $_POST['title'] ) || strlen($_POST['title']) < 1 || strlen($_POST['title']) > 60){
  echo 'Error title';
  return;
}
if( !isset( $_POST['description'] )  || strlen($_POST['description']) < 1){
  echo 'Error description';
  return;
}
if( !isset( $_POST['question'] )  || strlen($_POST['question']) < 1 || strlen($_POST['question']) > 100){
  echo 'Error question';
  return;
}
if( !isset( $_POST['trueAnswer'] )  || strlen($_POST['trueAnswer']) < 1 || strlen($_POST['trueAnswer']) > 60){
  echo 'Error true answer';
  return;
}
if( !isset( $_POST['level'] ) ){
  echo 'Error level';
  return;
}
if( !isset( $_POST['falseAnswer'] ) ){
  echo 'Error false answers';
  return;
}

$q = 'SELECT idLevel FROM LEVEL WHERE name = ?';
$req = $bdd->prepare($q);
$req->execute([$_POST['level']]);
$result = $req->fetchAll(PDO::FETCH_ASSOC);

if(count($result) != 1){
  header('Location:createEnigma.php?msg=Niveau inexistant');
  exit;

}


//image

$acceptable = [
  'image/jpeg',
  'image/jpg',
  'image/png',
  'image/gif',
];

$maxsize = 1024 * 1024; // 1Mo

if( $_FILES['image']['type'] != NULL && !in_array( $_FILES['image']['type'], $acceptable ) ){
  header('Location: createEnigma.php?msg=Fichier invalide');
  exit;
}

elseif($_FILES['image']['size'] > $maxsize){
header('Location: createEnigma.php?msg=Fichier trop volumineux');
exit;
}

$title = $_POST['title'];
$description = $_POST['description'];
$question = $_POST['question'];
$trueAnswer = $_POST['trueAnswer'];
$trick = $_POST['trick'];
$gain = 100;
$strFalseAnswers = $_POST['falseAnswer'];
$creationDate = date('Y-m-d H:i:s');
$level = $_POST['level'];

$q = 'INSERT INTO ENIGMA(title,description,question,answer,trick,gain,author,creationDate,enigmaLevel) VALUES(:title,:description,:question,:answer,:trick,:gain,:author,:creationDate,:enigmaLevel)';
$req = $bdd->prepare($q);
if($req == false){
  header('Location: createEnigma.php?msg=Erreur preparation');
  exit;
}
$req->execute([
                'title'       =>  $title,
                'description' =>  $description,
                'question'    =>  $question,
                'answer'      =>  $trueAnswer,
                'trick'       =>  $trick,
                'gain'        =>  $gain,
                'author'      =>  $_SESSION['id'],
                'creationDate'=>  $creationDate,
                'enigmaLevel' =>  $level
              ]);






?>
