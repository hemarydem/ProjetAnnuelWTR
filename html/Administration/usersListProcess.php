<?php
require('../includes/config.php');
$q = 'UPDATE USERS SET WORKING = 0 WHERE email = ?';											
$req = $bdd->prepare($q);
$req->execute([$_POST['suppr']]);
$q = 'SELECT working FROM USERS WHERE email = ?';
$req = $bdd->prepare($q);
$req->execute([$_POST['suppr']]);
$result = $req->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $key => $value) {
    echo $value['working']; 
}
?>