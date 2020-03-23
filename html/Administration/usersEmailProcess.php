<?php 
    require('../includes/config.php');
    $newMail =  $_POST['newEmail'];
    $oldMail = $_POST['oldEmail'];

        //___________find the usrer's login____________________\\
    if(isset($newMail) && isset($oldMail)){
        $queryOne = 'SELECT LOGIN FROM USERS WHERE EMAIL = ?';
        $requestOne = $bdd->prepare($queryOne);
        $requestOne->execute([$oldMail]);
        $login = $requestOne->fetch();
    }

        //to swap login in string\\
    $login = $login['LOGIN'];
    
     //___________change the usrer's mail address____________\\
    if($requestOne) {
        $qTwo = 'UPDATE USERS SET email = :newMail where login = :pseudo';									
        $reqTwo = $bdd->prepare($qTwo);
	    $reqTwo->execute([
            'newMail' => $newMail,
            'pseudo' => $login
        ]);
    }
    
        //___________check the new mail address and display it for the repsonse__________\\
    if($reqTwo) {
        $qThree = 'SELECT email FROM USERS WHERE email = :mail';
        $reqThree = $bdd->prepare($qThree);
        $reqThree->execute([
            'mail' => $newMail
        ]);
        $result = $reqThree->fetch();
        echo $result['email'];
        header('location: UserProfile.php?email='.$result['email']);
        exit;
    }else {
        echo 'data fail to update';
    }
?>