<?php 
require('../includes/config.php');
//initialization newEmail
if(isset($_POST['newEmail']) && !empty($_POST['oldEmail']) ){
    $newEmail = $_POST['newEmail'];
}
if(isset($_POST['oldEmail']) && !empty($_POST['oldEmail'])){
    $actualEmail = $_POST['oldEmail'];
}
// update of the new email
$q = 'UPDATE USERS SET email = ? WHERE email = ?';
$req = $bdd -> prepare($q);
$req->execute([ $newEmail, $actualEmail ]);
// search the new email to display it on userProfil admin page
$q2 = 'SELECT email FROM USERS WHERE email = ?';
$req2 = $bdd -> prepare($q2);
$req2->execute([$newEmail]);
$result = $req2->fetchAll(PDO::FETCH_ASSOC);
if(count($result) == 0) {
    echo 'le tableau est vide';
} else {
    foreach($result as $key => $value) {
        echo $value['email'];
    }
}
?>