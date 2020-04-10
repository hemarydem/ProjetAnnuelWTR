<?php

    require('includes/config.php');
    session_start();

    if( !isset( $_POST['reason'] )){
        header('Location:sendReportEnigma.php?msg= selectionner une raison');
        exit;
    }

    //get the users id
    $pseudo = $_SESSION['pseudo'];
    $q = 'SELECT idUser FROM USER WHERE login = ?';
    $req = $bdd->prepare($q);
    $req->execute([$pseudo]);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    print_r($result);
    $reporter = $result['idUser'];
    $enigma = $_GET['idEnigma'];

    date_default_timezone_set('Europe/Paris');
    $date = date('d-m-y h:i:s');

    $reason = ($_POST['reason']);
    //$details = htmlspecialchars($_POST['details']);

    $q = 'SELECT reporter, enigma FROM ENIGMAREPORT WHERE reporter = ? AND enigma=?';
    $req = $bdd->prepare($q);
    $req->execute([$reporter, $enigma]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    if(count($result) > 0){
		header('Location:reportEnigmaForm.php?msg=vous avez déjà signaler cette énigme&idEnigma='.$_GET['idEnigma']);
		exit;
	}

    if(!empty($reason)){

        $q = "INSERT INTO ENIGMAREPORT(reporter, enigma, reportDate, reason) VALUES (:reporter, :enigma, :reportDate, :reason)";
        $req = $bdd->prepare($q);
        $req->execute([
                        'reporter'      => $reporter,
                        'enigma'         => $enigma,
                        'reportDate'    => $date,
                        'reason'        => $reason
                    ]);
                
    }else{
        header('location:sendReportEnigma.php?msg=Remplissez tout les champs');
        exit;
    }

    header('location:index.php?');
    exit;
?>