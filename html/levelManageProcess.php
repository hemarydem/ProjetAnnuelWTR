<?php
 require('includes/config.php');
 session_start();
 if( !isset($_POST['idLevel']) ){
     echo 'Error: idLevel Not found';
     exit;
 }


 $idLevel = $_POST['idLevel'];


 if( isset($_POST['name']) ) {

    //-------check if the name already exists---//
    $q = 'SELECT name FROM LEVEL WHERE name = ?';
    $req = $bdd->prepare($q);
    $req->execute([$_POST['name']]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    if( count($result) > 0 ){
         echo 'error : name already exists';
         exit;
    }

    //----Set the new name--------------------//
    $q = 'UPDATE LEVEL SET name = :newName where idLevel = :id';
    $req = $bdd->prepare($q);
    $req->execute(['newName' => $_POST['name'],'id' => $idLevel]);

    //-------check and get back data to maine file-----//
    $q = 'SELECT name FROM LEVEL WHERE idLevel = :id';
    $req = $bdd->prepare($q);
    $req->execute(['id' => $idLevel]);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    echo $result['name'];
 }

 if( isset($_POST['threshold']) ) {

         //-------check if the name already exists---//
         $q = 'SELECT threshold FROM LEVEL WHERE threshold = ?';
         $req = $bdd->prepare($q);
         $req->execute([$_POST['threshold']]);
         $result = $req->fetchAll(PDO::FETCH_ASSOC);
         if( count($result) > 0 ){
             echo 'error : threshold value already exists';
             exit;
         }
         //----Set the new threshold--------------------//
        $q = 'UPDATE LEVEL SET threshold = :newthreshold where idLevel = :id';
        $req = $bdd->prepare($q);
        $req->execute(['newthreshold' => $_POST['threshold'],'id' => $idLevel]);

         //-------check and get back data to maine file-----//
         $q = 'SELECT threshold FROM LEVEL WHERE idLevel = :id';
         $req = $bdd->prepare($q);
         $req->execute(['id' => $idLevel]);
         $result = $req->fetch(PDO::FETCH_ASSOC);
        echo $result['threshold'];
 }

 if( isset($_POST['option'])) {
    if ($_POST['option'] == 1 ) {
        //----delete the level--------------------//
        $q = 'DELETE FROM LEVEL where idLevel = :id';
        $req = $bdd->prepare($q);
        $req->execute(['id' => $idLevel]);
    
        //-------check if the level was well deleted-----//
        $q = 'SELECT name FROM LEVEL WHERE idLevel = :id';
        $req = $bdd->prepare($q);
        $req->execute(['id' => $idLevel]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        if( $result == false){
             echo 1; //succes
        } else {
            echo 0;// error
        }
    }else {
        echo 2;// error
    }
 }
?>