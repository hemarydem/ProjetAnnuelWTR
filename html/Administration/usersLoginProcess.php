<?php
    if (isset($_POST['mail']) && isset($_POST['newLogin']) ) {
        require('../includes/config.php');
    $newPseudo =  $_POST['newLogin'];
    $mail = $_POST['mail'];
    
     //___________change the usrer's login____________\\
    $qOne = 'UPDATE USERS SET login = :newLogin where email = :mail';									
    $reqOne = $bdd->prepare($qOne);
    $reqOne->execute([
        'newLogin' => $newPseudo,
        'mail' => $mail
    ]);  
    header('location: UserProfile.php');
    exit;
}else {
    echo 'data fail to update';
} 
?>