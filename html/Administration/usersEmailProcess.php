<?php 
require('../includes/config.php');
//initialization newEmail
if(isset($_POST['newEmail']) && !empty($_POST['newEmail']) ){
    $newEmail = $_POST['newEmail'];
    echo '<br>'.$newEmail.'<br>';
}
if(isset($_POST['oldEmail']) && !empty($_POST['oldEmail'])){
    $actualEmail = $_POST['oldEmail'];
    echo '<br>'.$actualEmail.'<br>';
}
// update of the new email
$q = 'UPDATE USERS SET email = ? WHERE email = ?';
$req = $bdd -> prepare($q);
$req->execute([$newEmail, $actualEmail]);
////////////////////////////////////////
echo '<br>'.'////////////////////////////////';
$q1 = 'SELECT * FROM USERS WHERE email = ?';
$req1 = $bdd -> prepare($q1);
$req1->execute([$newEmail]);
$result1 = $req1->fetchAll(PDO::FETCH_ASSOC);
print_r($result1);
echo '<br>'.'////////////////////////////////'.'<br>';
////////////////////////////////////////
// search the new email to display it on userProfil admin page
$q2 = 'SELECT email FROM USERS WHERE email = ?';
$req2 = $bdd -> prepare($q2);
$req2->execute([$newEmail]);
$result = $req2->fetchAll(PDO::FETCH_ASSOC);
print_r($result);
//if(count($result) == 0) {
//    echo 'le tableau est vide '. $newEmail;
//} else {
    foreach($result as $key => $value) {
        echo $value['email'];
    }
//}
?>