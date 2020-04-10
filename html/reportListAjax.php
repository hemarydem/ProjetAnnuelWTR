<?php
 require('includes/config.php');
 session_start();

 
if(isset($_GET['option']) && $_GET['option'] == 1) {
     //function like to searchReportEnigma() on reportListAjac.js to find all reported topic
     $q = 'SELECT TOPICREPORT.reporter, TOPICREPORT.topic, TOPICREPORT.reportDate, TOPICREPORT.reason, USER.login, Topic.title, REPORTREASON.reason FROM TOPICREPORT INNER JOIN USER ON TOPICREPORT.reporter = USER.idUser INNER JOIN Topic ON TOPICREPORT.topic = topic.idTopic INNER JOIN REPORTREASON ON TOPICREPORT.reason = REPORTREASON.idReason';
     $req = $bdd->prepare($q);
     $req->execute([]);
     $result = $req->fetchAll(PDO::FETCH_ASSOC);
     if( count($result) == 0 ){
          echo 'error : there is no report';
          exit;
     }
     header('Content-Type: application/json');
     echo json_encode($result);
}

if(isset($_GET['option']) && $_GET['option'] == 2) {
     //function like to searchReportEnigma() on reportListAjac.js to find all reported topic
     $q = 'SELECT ENIGMAREPORT.reporter, ENIGMAREPORT.enigma, ENIGMAREPORT.reportDate, ENIGMAREPORT.reason, USER.login, ENIGMA.title, REPORTREASON.reason FROM ENIGMAREPORT INNER JOIN USER ON ENIGMAREPORT.reporter = USER.idUser INNER JOIN ENIGMA ON ENIGMAREPORT.enigma = ENIGMA.idEnigma INNER JOIN REPORTREASON ON ENIGMAREPORT.reason = REPORTREASON.idReason';
     $req = $bdd->prepare($q);
     $req->execute([]);
     $result = $req->fetchAll(PDO::FETCH_ASSOC);
     if( count($result) == 0 ){
          echo 'error : there is no report';
          exit;
     }
     header('Content-Type: application/json');
     echo json_encode($result);
}

if(isset($_GET['option']) && $_GET['option'] == 3) {
     //function like to searchReportEnigma() on reportListAjac.js to find all reported topic
     $q = 'SELECT MESSAGEREPORT.reporter, MESSAGEREPORT.message, MESSAGEREPORT.reportDate, MESSAGEREPORT.reason, USER.login, MESSAGE.content, REPORTREASON.reason FROM MESSAGEREPORT INNER JOIN USER ON MESSAGEREPORT.reporter = USER.idUser INNER JOIN MESSAGE ON MESSAGEREPORT.message = Message.idmessage INNER JOIN REPORTREASON ON MESSAGEREPORT.reason = REPORTREASON.idReason';
     $req = $bdd->prepare($q);
     $req->execute([]);
     $result = $req->fetchAll(PDO::FETCH_ASSOC);
     if( count($result) == 0 ){
          echo 'error : there is no report';
          exit;
     }
     header('Content-Type: application/json');
     echo json_encode($result);
}
 
?>
