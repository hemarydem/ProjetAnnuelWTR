<?php

session_start();
require('includes/config.php');

//The player is connected
if( !isset( $_SESSION['id'] ) ){
    header('Location:signIn.php?');
    exit;
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

if( !isset( $_POST['level'] ) ){
  echo 'Error level';
  return;
}

$q = 'SELECT idLevel FROM LEVEL WHERE name = ?';
$req = $bdd->prepare($q);
$req->execute([$_POST['level']]);
$result = $req->fetchAll(PDO::FETCH_ASSOC);

if(count($result) != 1){
  header('Location:createEnigmaImg.php?msg=Niveau inexistant');
  exit;
}

$level = $result[0]['idLevel'];

//Unicity of title 
$q = 'SELECT title FROM ENIGMA WHERE title = ?';
$req = $bdd->prepare($q);
$req->execute([$_POST['title']]);
$result = $req->fetchAll(PDO::FETCH_ASSOC);
if(count($result) > 0){
  header('Location:createEnigmaImg.php?msg=Titre déjà prit');
  exit;
}


//
$acceptable = [
    'image/jpeg',
    'image/jpg',
    'image/png',
    'image/gif',
  ];

$maxsize = 1024 * 1024; // 1Mo



?>