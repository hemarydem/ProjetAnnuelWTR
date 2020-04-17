<?php
    require('includes/config.php');
    session_start();
    if( !isset($_POST['mail']) ){
        echo 'Error: Mail Not found';
        exit;
    }

    $mail = $_POST['mail'];
    $req = $bdd->prepare('SELECT idUser FROM USER WHERE email = ?');
    $req->execute([$_POST['mail']]);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    $idUser = $result['idUser'];


    if( isset($_POST['moderator']) ){

        //___________check the value of user's moderator____________\\
        $q = 'SELECT moderator FROM USER WHERE idUser = :idUser';
        $req = $bdd->prepare($q);
        $req->execute(['idUser' => $idUser]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $result = $result['moderator'];

        if($result == 1){
            $q = 'UPDATE USER SET moderator = 0 where idUser = :idUser';
            $req = $bdd->prepare($q);
            $req->execute(['idUser' => $idUser]);
        } else {
            $q = 'UPDATE USER SET moderator = 1 where idUser = :idUser';
            $req = $bdd->prepare($q);
            $req->execute(['idUser' => $idUser]);
        }
        $q = 'SELECT moderator FROM USER WHERE idUser = :idUser';
        $req = $bdd->prepare($q);
        $req->execute(['idUser' => $idUser]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
    echo $result['moderator'];
    }

    if( isset($_POST['active']) ){

        //___________check the value of user's moderator____________\\
        $q = 'SELECT active FROM USER WHERE idUser = :idUser';
        $req = $bdd->prepare($q);
        $req->execute(['idUser' => $idUser]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $result = $result['active'];

        if($result == 1){
            $q = 'UPDATE USER SET active = 0 where idUser = :idUser';
            $req = $bdd->prepare($q);
            $req->execute(['idUser' => $idUser]);
        } else {
            $q = 'UPDATE USER SET active = 1 where idUser = :idUser';
            $req = $bdd->prepare($q);
            $req->execute(['idUser' => $idUser]);
        }
        $q = 'SELECT active FROM USER WHERE idUser = :idUser';
        $req = $bdd->prepare($q);
        $req->execute(['idUser' => $idUser]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        echo $result['active'];
    }


    if( isset($_POST['newMail']) ){
        if( !filter_var($_POST['newMail'], FILTER_VALIDATE_EMAIL) ){
            echo 'error : invalid email';
            exit;
        }

        //-------check if the mail already exists
        $q = 'SELECT email FROM USER WHERE email = ?';
        $req = $bdd->prepare($q);
        $req->execute([$_POST['newMail']]);
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        if( count($result) > 0 ){
            echo 'error : email already exists';
            exit;
        }


        $q = 'UPDATE USER set email = :newMail WHERE idUser = :idUser';
        $req = $bdd->prepare($q);
        $req->execute([
            'newMail' => $_POST['newMail'],
            'idUser' => $idUser
            ]);

            $q = 'SELECT email FROM USER WHERE idUser = ?';
            $req = $bdd->prepare($q);
            $req->execute([$idUser]);
            $result = $req->fetch(PDO::FETCH_ASSOC);
            echo $result['email'];

    }

    if(isset($_POST['newLogin'])) {

        if( strlen($_POST['newLogin']) < 5 || strlen($_POST['newLogin']) > 16 ){
            echo 'error: Longueur invalide';
            exit;
        }

        $q = 'UPDATE USER set login = :newLogin WHERE idUser = :idUser';
        $req = $bdd->prepare($q);
        $req->execute([
            'newLogin' => $_POST['newLogin'],
            'idUser' => $idUser
        ]);
        $q = 'SELECT login FROM USER WHERE idUser = ? AND login = ?';
        $req = $bdd->prepare($q);
        $req->execute( [$idUser, $_POST['newLogin'] ] );
        $result = $req->fetch(PDO::FETCH_ASSOC);
        echo $result['login'];
    }
    
    if(isset($_POST['addPoints']) && $_POST['addPoints'] > 0) {

        $q = 'SELECT points FROM USER WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute([
            'mail' => $_POST['mail']
        ]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $_POST['addPoints'] += $result['points'];

        $q = 'UPDATE USER set points = :addPoints WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute([
            'addPoints' => $_POST['addPoints'],
            'mail' => $_POST['mail']
        ]);

        $q = 'SELECT points FROM USER WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute([
            'mail' => $_POST['mail']
        ]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        echo $result['points'];
    }

    if(isset($_POST['removePoints']) && $_POST['removePoints'] > 0) {

        $q = 'SELECT points FROM USER WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute([
            'mail' => $_POST['mail']
        ]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $_POST['removePoints'] = $result['points'] - $_POST['removePoints'];

        $q = 'UPDATE USER set points = :removePoints WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute([
            'removePoints' => $_POST['removePoints'],
            'mail' => $_POST['mail']
        ]);

        $q = 'SELECT points FROM USER WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute([
            'mail' => $_POST['mail']
        ]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        echo $result['points'];
    }

    if(isset($_POST['newUserLevel'])) {
        //get the id of the new level
        $q = 'SELECT threshold FROM Level WHERE name = :nwlevel';
        $req = $bdd->prepare($q);
        $req->execute([
            'nwlevel' => $_POST['newUserLevel']
        ]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        
        //set the new level on the user's table
        $q = 'UPDATE USER set points = :nwlevel WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute([
            'nwlevel' => $result['threshold'],
            'mail' => $_POST['mail']
        ]);

        $array = [
            'threshold' => $result['threshold'],
            'newUserLevel' => $_POST['newUserLevel']
        ];
        header('Content-Type: application/json');
        echo json_encode($array);
        
       // echo $_POST['newUserLevel'];
    }
//--------------------ban-------------------------------//
    if(isset($_POST['banneDays']) && $_POST['banneDays'] > 0) {

        $_POST['banneDays'] = (int)$_POST['banneDays'];
        //echo$_POST['mail'];
        //echo $flag;
        $datetime = date('Y-m-d');
        $flag =  date('Y-m-d', strtotime($datetime. ' + '.$_POST['banneDays'].' days'));
        
        $q = 'UPDATE USER set FLAGBAN = :days WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute([
            'days' => $flag,
            'mail' => $_POST['mail']
        ]);

        $q = 'UPDATE USER set COUNTERBAN = COUNTERBAN + 1 WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute([ 'mail' => $_POST['mail']]);
    }
//-------------------- delete ban-------------------------------//
    if(isset($_POST['endBan'])) {

        $datetime = date('Y-m-d');
        $flag =  date('Y-m-d', strtotime($datetime.'-1 days'));
        
        $q = 'UPDATE USER set FLAGBAN = :days WHERE email = :mail';
        $req = $bdd->prepare($q);
        $req->execute([
            'days' => $flag,
            'mail' => $_POST['mail']
        ]);
    }
    
?>
