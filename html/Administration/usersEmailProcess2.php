<?php 
require('../includes/config.php');
if((isset($_POST['newEmail']) && !empty($_POST['newEmail'])) && (isset($_POST['oldEmail']) && !empty($_POST['oldEmail']))){
    $newEmail = $_POST['newEmail'];
    $actualEmail = $_POST['oldEmail'];
    //$startReq = 'SELECT email FROM USERS WHERE email = ?';

    //$q = 'UPDATE USERS SET email = :newMail WHERE email = :oldEmail';
    $q = 'UPDATE USERS SET email = ? WHERE email = ?';
    $req = $bdd->prepare($q);
    //$req->bindValue(':oldEmail', $actualEmail, PDO::PARAM_STR);
    //$req->bindValue(':newMail', $newEmail, PDO::PARAM_STR);
    //$req->execute();
    $req->execute([$newEmail, $actualEmail]);
    if($req) {
        $q2 = 'SELECT * FROM USERS';
        $req2 = $bdd->query($q2);
        //$req2->bindValue(':newMail', $newEmail, PDO::PARAM_STR);
        //req2->execute();
        //$req2->execute([$newEmail]);
        $result = $req2->fetchAll(PDO::FETCH_ASSOC);
        //if(count($result) == 0) {
          //  echo 'error result is empty';
        //}
        //echo $result[0]['email'];
        if($req2) {
            foreach($result as $key => $value) {
                if($value['email'] == $newEmail){
                    echo $value['email'];
                }
            }
        } else {
            echo 'error to find the new email';
        }
    } else {
        echo 'error update of the mail doesn\'t work';
    }
}
?>