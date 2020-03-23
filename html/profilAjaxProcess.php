<?php
    require('includes/config.php');
    session_start();
    if( !isset($_POST['mail']) ){
        echo 'Error: Mail Not found';
        exit;
    }

    $mail = $_POST['mail'];

    if( isset($_POST['moderator']) ){
        
        //___________check the value of user's moderator____________\\
        $q = 'SELECT moderator FROM USERS WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute(['mail' => $mail]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $result = $result['moderator'];
    
        if($result == 1){
            $q = 'UPDATE USERS SET moderator = 0 where email = :mail';
            $req = $bdd->prepare($q);
            $req->execute(['mail' => $mail]);
        } else { 
            $q = 'UPDATE USERS SET moderator = 1 where email = :mail';
            $req = $bdd->prepare($q);
            $req->execute(['mail' => $mail]);
        }
        $q = 'SELECT moderator FROM USERS WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute(['mail' => $mail]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
    echo $result['moderator'];
    }

    if( isset($_POST['working']) ){
        
        //___________check the value of user's moderator____________\\
        $q = 'SELECT working FROM USERS WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute(['mail' => $mail]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $result = $result['working'];
    
        if($result == 1){
            $q = 'UPDATE USERS SET working = 0 where email = :mail';
            $req = $bdd->prepare($q);
            $req->execute(['mail' => $mail]);
        } else { 
            $q = 'UPDATE USERS SET working = 1 where email = :mail';
            $req = $bdd->prepare($q);
            $req->execute(['mail' => $mail]);
        }
        $q = 'SELECT working FROM USERS WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute(['mail' => $mail]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        echo $result['working'];
    }


    if( isset($_POST['newMail']) ){
        if( !filter_var($_POST['newMail'], FILTER_VALIDATE_EMAIL) ){
            echo 'error : invalid email';
            exit;
        }

        //-------check if the mail already exists
        $q = 'SELECT email FROM USERS WHERE email = ?';
        $req = $bdd->prepare($q);
        $req->execute([$_POST['newMail']]);
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        if( count($result) > 0 ){
            echo 'error : email already exists';
            exit;
        }
        
        
        $q = 'UPDATE USERS set email = :newMail WHERE email = :oldMail';
        $req = $bdd->prepare($q);
        $req->execute([
            'newMail' => $_POST['newMail'],
            'oldMail' => $_POST['mail']
            ]);
        
            $q = 'SELECT email FROM USERS WHERE email = ?';
            $req = $bdd->prepare($q);
            $req->execute([$_POST['newMail']]);
            $result = $req->fetch(PDO::FETCH_ASSOC);
            echo $result['email'];
            
    }
    
    if(isset($_POST['newLogin'])) {

        if( strlen($_POST['newLogin']) < 5 || strlen($_POST['newLogin']) > 16 ){
            echo 'error: Longueur invalide';
            exit;
        }

        $q = 'UPDATE USERS set login = :newLogin WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute([
            'newLogin' => $_POST['newLogin'],
            'mail' => $_POST['mail']
        ]);
        $q = 'SELECT login FROM USERS WHERE email = ? AND login = ?';
        $req = $bdd->prepare($q);
        $req->execute([$_POST['mail'], $_POST['newLogin']]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        echo $result['login'];
    }
   
    
?>