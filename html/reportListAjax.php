<?php
 require('includes/config.php');
 session_start();

 //TOPICREPORT(reporterPrimar,topicPrimary, reportDate	,reason

 
 //Topic(title, content, active, postDate, author)
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
?>
