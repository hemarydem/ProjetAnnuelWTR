<?php
    require('../includes/config.php');
if (isset($_POST['mail']) ) {
    $mail = $_POST['mail'];
    
    //___________check the value of user's moderator____________\\
    $qOne = 'SELECT WORKING FROM USERS WHERE email = :mail';
    $reqOne = $bdd->prepare($qOne);
    $reqOne->execute(['mail' => $mail]);
    $result = $reqOne->fetch();

    $result = $result[0]['WORKING'];

    if($result == 1){
        $qtwo = 'UPDATE USERS SET WORKING = 0 where email = :mail';
        $reqTwo = $bdd->prepare($qtwo);
        $reqTwo->execute(['mail' => $mail]);
    }else { 
        $qtwo = 'UPDATE USERS SET WORKING = 1 where email = :mail';
        $reqTwo = $bdd->prepare($qtwo);
        $reqTwo->execute(['mail' => $mail]);
    }
    header('location: UserProfile.php?email='.$mail);
    exit;
}else {
    echo 'data fail to update';
} 
?>
