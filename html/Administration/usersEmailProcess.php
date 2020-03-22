<?php 
require('../includes/config.php');
//request.send(`newEmail=${inputMail}&oldEmail=${actualMail}`);
if(isset($_POST['newEmail']) && isset($_POST['oldEmail'])){
    $data = $_POST['oldEmail'];
    $q = 'SELECT email, login FROM USERS WHERE email = ? ';
    $req = $bdd->prepare($q);
    $req->execute([$data]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    echo $result[0]['email'].'<br>';
    //echo $result[0]['login'].'<br>';
    
    //$data = $result[0]['login'];
    $newMail = $_POST['newEmail'];
    $q2 = 'UPDATE USERS SET email =?  WHERE login = ? ';
    $req2 = $bdd->prepare($q2);
    $req2->execute([$newMail,$data]);

    $data = $_POST['newEmail'];
    $q = 'SELECT email, login FROM USERS WHERE email = ? ';
    $req = $bdd->prepare($q);
    $req->execute([$data]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    //echo 'après update'.'<br>';
    echo $result[0]['email'];
    //echo $result[0]['login'].'<br>';
}
?>