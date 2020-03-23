<?php
session_start();

//le joueur est connecté
if( !isset( $_SESSION['pseudo'] ) ){
  header('Location: signIn.php');
  exit;
}

//trim des inputs
foreach ($_POST as $key => $value) {
  $_POST[$key] = trim( $_POST[$key] );
}


// Vérifivation des inputs
if( !isset( $_POST['title'] ) || strlen($_POST['title']) < 5 || strlen($_POST['title']) > 60){
  header('Location: createEnigma.php?msg=Titre invalide');
  exit;
}
if( !isset( $_POST['description'] )  || strlen($_POST['description']) < 5){
  header('Location: createEnigma.php?msg=Description invalide');
  exit;
}
if( !isset( $_POST['question'] )  || strlen($_POST['question']) < 5 || strlen($_POST['question']) > 100){
  header('Location: createEnigma.php?msg=Question invalide');
  exit;
}
if( !isset( $_POST['answer'] )  || strlen($_POST['answer']) < 5 || strlen($_POST['answer']) > 60){
  header('Location: createEnigma.php?msg=Réponse invalide');
  exit;
}
if( !isset( $_POST['trick'] )  || strlen($_POST['trick']) < 5 || strlen($_POST['trick']) > 100 ){
  header('Location: createEnigma.php?msg=Astuce invalide');
  exit;
}
if( !isset( $_POST['minutes'] ) || !isset( $_POST['seconds'] ) || $_POST['minutes'] < 0 || $_POST['seconds'] < 0 ){
  header('Location: createEnigma.php?msg=Temps invalide');
  exit;
}

//vérif image
$acceptable = [
  'image/jpeg',
  'image/jpg',
  'image/png',
  'image/gif',
];

$maxsize = 1024 * 1024; // 1Mo

if( isset($_FILES['image']['type']) && !in_array( $_FILES['image']['type'], $acceptable ) ){
  header('Location: createEnigma.php?msg=Fichier invalide');
	exit;
}

//image < 1Mo
elseif(isset($_FILES['image']['type']) && $_FILES['image']['size'] > $maxsize){
  header('Location: createEnigma.php?msg=Fichier trop volumineux');
	exit;
}

//récupérer l'id de l'adhérent
echo $_SESSION['pseudo'];

//préparer les variables
$title = $_POST['title'];
$description = $_POST['description'];
$question = $_POST['question'];
$answer = $_POST['answer'];
$trick = $_POST['trick'];
$gain = 100;
$working = 1;
$author = $id;
$creationDate = date(Y-m-d);
$enigmaLevel = 'beginner';

//ajouter l'énigme dans la bdd sans l'image
//télécharger l'image
  //chemin d'enregistrement
  //récuperer l'id de l'énigme ajoutée
  //renomer l'image avec l'id de l'énigme et la date
  //déplacer l'image dans : img/enigma/
  //insérer le chemin dans la bdd
  //rediction vers l'acceuil

?>
