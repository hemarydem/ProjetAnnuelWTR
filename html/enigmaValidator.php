<?php
session_start();
require('includes/config.php');

//le joueur est connecté
if( !isset( $_SESSION['pseudo'] ) ){
  header('Location: signIn.php');
  exit;
}
$pseudo = $_SESSION['pseudo'];

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
if( !isset( $_POST['level'] ) ){
  header('Location: createEnigma.php?msg=Réponse invalide');
  exit;
}else{
  //check the level really exists in the bdd
  $q = 'SELECT name FROM LEVEL WHERE name = ?';
  $req = $bdd->prepare($q);
  $req->execute([$_POST['level']]);
  $result = $req->fetch(PDO::FETCH_ASSOC);
  if( count( $result ) == 0 ){
    header('Location: createEnigma.php?msg=Réponse invalide');
    exit;
  }else{
    $level = $result['name'];
  }
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

if( $_FILES['image']['type'] != NULL && !in_array( $_FILES['image']['type'], $acceptable ) ){
  header('Location: connexion.php?msgInscription=Fichier invalide');
  exit;
}

elseif($_FILES['image']['size'] > $maxsize){
header('Location: connexion.php?msgInscription=Fichier trop volumineux');
exit;
}

//récupérer l'id de l'adhérent
$q = 'SELECT email FROM USERS WHERE login = ?';
  $req = $bdd->prepare($q);
  $req->execute([ $pseudo ]);
  $result = $req->fetch(PDO::FETCH_ASSOC);
  $author = $result['email'];


//préparer les variables
$title = htmlspecialchars($_POST['title']);
$description = htmlspecialchars($_POST['description']);
$question = htmlspecialchars($_POST['question']);
$answer = htmlspecialchars($_POST['answer']);
$trick = htmlspecialchars($_POST['trick']);
$gain = 100;
$creationDate = date('Y-m-d');

//ajouter l'énigme dans la bdd sans l'image
$q = 'INSERT INTO ENIGMA(title,description,question,answer,trick,gain,author,creationDate,enigmaLevel) VALUES(:title,:description,:question,:answer,:trick,:gain,:author,:creationDate,:enigmaLevel)';
$req = $bdd->prepare($q);
$req->execute([
                'title'       =>  $title,
                'description' =>  $description,
                'question'    =>  $question,
                'answer'      =>  $answer,
                'trick'       =>  $trick,
                'gain'        =>  $gain,
                'author'      =>  $author,
                'creationDate'=>  $creationDate,
                'enigmaLevel' =>  $level
              ]);

$q = 'SELECT * FROM ENIGMA WHERE title = ?';
$req = $bdd->prepare($q);
$req->execute([$title]);
$result= $req->fetchAll(PDO::FETCH_ASSOC);

//télécharger l'image
  //chemin d'enregistrement
  //récuperer l'id de l'énigme ajoutée
  //renomer l'image avec l'id de l'énigme et la date
  //déplacer l'image dans : img/enigma/
  //insérer le chemin dans la bdd
  //rediction vers l'acceuil

?>
