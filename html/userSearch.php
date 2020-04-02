<?php
require('includes/config.php');

if(isset($_POST['emailKeyWord'])) {
    $q = "SELECT email, creationDate, active,login FROM USER WHERE email LIKE ? OR login LIKE ?";
    $req = $bdd->prepare($q);
    $unknowEmail = $_POST['emailKeyWord'].'%';
    $req->execute([$unknowEmail, $unknowEmail]);
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($results);
  }
?>
