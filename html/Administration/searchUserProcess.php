<?php
require('../includes/config.php');
if(isset($_POST['emailKeyWord'])) {
  $q = "SELECT email, creationDate, working,login FROM USERS WHERE email LIKE ?";											
  $req = $bdd->prepare($q);
  $unknowEmail = $_POST['emailKeyWord'].'%';
  $req->execute([$unknowEmail]);
  $results = $req->fetchAll(PDO::FETCH_ASSOC);
  header('Content-Type: application/json');
  echo json_encode($results);
}
if(isset($_POST['pseudoKeyWord'])) {
  $q = "SELECT email, creationDate, working,login FROM USERS WHERE pseudo LIKE ?";											
  $req = $bdd->prepare($q);
  $unknowPseudo = $_POST['pseudoKeyWord'].'%';
  $req->execute([$unknowPseudo]);
  $results = $req->fetchAll(PDO::FETCH_ASSOC);
  header('Content-Type: application/json');
  echo json_encode($results);
}
?>