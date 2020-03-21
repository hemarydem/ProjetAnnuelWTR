<?php 
require('../includes/config.php');
if(isset($_POST['newEmail'])&& !empty($_POST['newEmail'])){
    $newEmail = $_POST[''];
}
if(isset($_POST['oldEmail'])&& !empty($_POST['oldEmail'])){
    $actualEmail = $_POST['oldEmail'];
}
$q = 'UPDATE USERS SET email = ? WHERE email = ?';
$req = $bdd -> prepare($q);
$req->execute(array($actualEmail, $newEmail));

$q2 = 'SELECT email FROM USERS WHERE email = ?';
$req2 = $bdd -> prepare($q2);
$req2->execute(array($newEmail));
$result = $req2->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $key => $value) {
    echo $result;
}
?>