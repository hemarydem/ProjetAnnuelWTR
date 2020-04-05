<?php
require('includes/config.php');
//___________Search by name______________//
if(isset($_POST['levelName']) &&$_POST['option'] == 0) {
    $q = "SELECT name, threshold, idLevel FROM LEVEL WHERE name LIKE ?";
    $req = $bdd->prepare($q);
    $unKnowLevel = $_POST['levelName'].'%';
    $req->execute([$unKnowLevel]);
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($results);
  } elseif(isset($_POST['threshold']) &&$_POST['option'] == 1) {
      //___________Search by all under threshold was input by the user______________//
    $q = "SELECT name, threshold, idLevel FROM LEVEL WHERE threshold < ?";
    $req = $bdd->prepare($q);
    $unKnowLevel = $_POST['threshold'];
    $req->execute([$unKnowLevel]);
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  //___________Search by all under threshold was input by the user and level name______________//
  if(isset($_POST['levelName']) && isset($_POST['threshold']) &&$_POST['option'] == 3) {
    $q = "SELECT name, threshold, idLevel FROM LEVEL WHERE name LIKE ? AND threshold < ?";
    $req = $bdd->prepare($q);
    $unKnowLevel = $_POST['levelName'].'%';
    $unKnowthreshold = $_POST['threshold'];
    $req->execute([$unKnowLevel, $unKnowthreshold]);
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($results);
  }

?>
