<?php
    require('../includes/config.php');
if (isset($_POST['mail']) ) {
    $moderator =  $_POST['moderator'];
    $mail = $_POST['mail'];
    
    //___________check the value of user's moderator____________\\
    $qOne = 'SELECT MODERATOR FROM USERS WHERE email = :mail';
    $reqOne = $bdd->prepare($qOne);
    $reqOne->execute(['mail' => $mail]);
    $result = $reqOne->fetch();

    $result = $result[0]['MODERATOR'];

    if($result == 1){
        $qtwo = 'UPDATE USERS SET MODERATOR = 0 where email = :mail';
        $reqTwo = $bdd->prepare($qtwo);
        $reqTwo->execute(['mail' => $mail]);
    }else { 
        $qtwo = 'UPDATE USERS SET MODERATOR = 1 where email = :mail';
        $reqTwo = $bdd->prepare($qtwo);
        $reqTwo->execute(['mail' => $mail]);
    }
    header('location: UserProfile.php?email='.$mail);
    exit;
}else {
    echo 'data fail to update';
} 
?>