<?php 
require('../includes/config.php');
//echo $_POST['newEmail'].' '.$_POST['oldEmail'];
if(isset($_GET['newEmail']) && isset($_GET['oldEmail'])){
    $query = "SELECT * FROM USERS";
    $testReq = $bdd->prepare($query);
    $testReq->execute();
    $result = $testReq->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $key => $value) {
        echo $value['email'];
    }

    $q = 'UPDATE USERS SET email = ? WHERE email = ?';											
    $req = $bdd->prepare($q);
    $req->execute([$_GET['newEmail'],$_GET['oldEmail']]);
    $q = 'SELECT email FROM USERS WHERE email = ?';
    $req = $bdd->prepare($q);
    $req->execute([$_GET['newEmail']]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    echo count($result);
    foreach($result as $key => $value) {
        echo $value['email'];
        $_GET['email'] = $value['email'];
    }
}
    
?>