<?php 
require('../includes/config.php');
if(isset($_POST['newEmail']) &&  isset($_POST['oldEmail'])){
    $q = 'UPDATE USERS SET EMAIL= ? WHERE EMAIL = ?';											
    $req = $bdd->prepare($q);
    $req->execute([$_POST['newEmail'],$_POST['oldEmail']]);
    $q = 'SELECT EMAIL FROM USERS WHERE EMAIL = ?';
    $req = $bdd->prepare($q);
    $req->execute([$_POST['newEmail']]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $key => $value) {
        echo $value['EMAIL']; 
    }
}
?>