<?php 
require('../includes/config.php');
if(isset($_POST['email'])){
    $email = $_POST['email'];
}

//swapp the new address withe the old
if(isset($_POST['newPseudo'])) {
    $newPseudo = $_POST['newPseudo'];
    //echo $newEmail; 
}

$q = 'UPDATE USERS SET login = ? WHERE email = ?';
$req = $bdd->prepare($q);
$req->execute( [$newPseudo,$email]);

//get back the new email to the main file
$q2 = "SELECT login FROM USERS WHERE email=?";											
$req2 = $bdd->prepare($q2);
$req2->execute([$email]);
$results = $req2->fetchAll(PDO::FETCH_ASSOC);
//print_r($results);
//header('Content-Type: application/json');
foreach($results as $key => $value){
    echo $value['login'];
}
?>