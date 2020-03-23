<?php 
require('../includes/config.php');
if((isset($_POST['newPseudo']) && !empty($_POST['newPseudo'])) && (isset($_POST['email']) && !empty($_POST['email']))){
    $q = 'UPDATE USERS SET LOGIN= ? WHERE EMAIL = ?';											
    $req = $bdd->prepare($q);
    $req->execute([$_POST['newPseudo'],$_POST['email']]);
    $q = 'SELECT LOGIN FROM USERS WHERE EMAIL = ?';
    $req = $bdd->prepare($q);
    $req->execute([$_POST['email']]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $key => $value) {
        echo $value['LOGIN']; 
    }
  
}
?>