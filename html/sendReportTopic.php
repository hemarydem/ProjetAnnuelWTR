<?php

    require('includes/config.php');
    session_start();

    if( !isset( $_POST['reason'] ) ||  !isset( $_POST['details'] ) ){
        header('Location:report.php?msg= Remplissez tout les champs');
        exit;
    }

    //Récupérer l'id de l'utilisateurs
    $pseudo = $_SESSION['pseudo'];
    $q = 'SELECT idUser FROM USER WHERE login = ?';
    $req = $bdd->prepare($q);
    $req->execute([$pseudo]);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    
    $reporter = $result['idUser'];
    $topic = $_GET['idTopic'];

    date_default_timezone_set('Europe/Paris');
    $date = date('d-m-y h:i:s');

    $reason = ($_POST['reason']);
    $details = htmlspecialchars($_POST['details']);


    if(!empty($details)){

        $q = "INSERT INTO topicreport(reporter, topic, reportDate, reason, details) VALUES (:reporter, :topic, :reportDate, :reason, :details)";
        $req = $bdd->prepare($q);
        $req->execute([
                        'reporter'      => $reporter,
                        'topic'         => $topic,
                        'reportDate'    => $date,
                        'reason'        => $reason,
                        'details'       => $details
                    ]);

    }else{
        header('location:report.php?msg=Remplissez tout les champs');
        exit;
    }

    header('location:forum.php?');
    exit;
?>