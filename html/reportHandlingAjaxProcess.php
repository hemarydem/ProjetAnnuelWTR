<?php
require('includes/config.php');


//////////////////////////////////////////////////////////////////////////// 
/////////////////////////////          topic                  ////////////// 
//////////////////////////////////////////////////////////////////////////// 

//----------------turn off a topic----------------//
if(isset($_POST['idTopic']) && $_POST['reporter'] && $_POST['option'] == 1){
    $req = $bdd->prepare('UPDATE Topic SET active = 0 WHERE idTopic = :id');
    $req->execute([ 'id' => $_POST['idTopic']]);

    $req = $bdd->prepare('SELECT  active FROM Topic WHERE idTopic = ?');
    $req->execute([ $_POST['idTopic'] ]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    echo $result [0]['active'];
    
    //delete the report because it was handled           
    $req = $bdd->prepare('DELETE FROM `TOPICREPORT` WHERE topic= :id AND reporter = :orgineReporter');
    $req->execute(['id' => $_POST['idTopic'], 'orgineReporter' => $_POST['reporter']]);

}

//_________to delele a report-------/
if(isset($_POST['idTopic']) && isset($_POST['reporter']) && $_POST['option'] == 2){
    // only delet report because there is nothing to report
    $req = $bdd->prepare('DELETE FROM `TOPICREPORT` WHERE topic= :id AND reporter = :orgineReporter');
    $req->execute(['id' => $_POST['idTopic'], 'orgineReporter' => $_POST['reporter']]);

}

//////////////////////////////////////////////////////////////////////////// 
/////////////////////////////          enigma                  /////////////
//////////////////////////////////////////////////////////////////////////// 

//Delete an Enigma
if(isset($_POST['idEnigma']) && isset($_POST['reporter']) && $_POST['option'] == 3){
    $req = $bdd->prepare('UPDATE ENIGMA SET active=0 WHERE idEnigma = :id');
    $req->execute([ 'id' => $_POST['idEnigma']]);
    $req = $bdd->prepare('SELECT active FROM ENIGMA WHERE idEnigma = ?');
    $req->execute([ $_POST['idEnigma'] ]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    echo $result [0]['active'];
    
    //delete the report because it was handled           
    $req = $bdd->prepare('DELETE FROM `ENIGMAREPORT` WHERE enigma= :id AND reporter = :orgineReporter');
    $req->execute(['id' => $_POST['idEnigma'], 'orgineReporter' => $_POST['reporter']]);

}

//_________to delele a report-------/
if(isset($_POST['idEnigma']) && $_POST['reporter'] && $_POST['option'] == 4){
    // only delet report because there is nothing to report
    $req = $bdd->prepare('DELETE FROM `ENIGMAREPORT` WHERE enigma= :id AND reporter = :orgineReporter');
    $req->execute(['id' => $_POST['idEnigma'], 'orgineReporter' => $_POST['reporter']]);

}