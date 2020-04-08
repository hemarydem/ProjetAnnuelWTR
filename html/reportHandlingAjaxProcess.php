<?php
require('includes/config.php');

if(isset($_POST['idTopic']) && $_POST['option'] == 1){
    $req = $bdd->prepare('UPDATE Topic SET active = 0 WHERE idTopic = :id');
    $req->execute([ 'id' => $_POST['idTopic']]);


    $req = $bdd->prepare('SELECT  active FROM Topic WHERE idTopic = ?');
                $req->execute([ $_POST['idTopic'] ]);
                $result = $req->fetchAll(PDO::FETCH_ASSOC);
                echo $result [0]['active'];

}


//_________to delele a report-------/
if(isset($_POST['idTopic']) && $_POST['option'] == 2){

    $req = $bdd->prepare('DELETE FROM `TOPICREPORT` WHERE topic= :id AND reporter = :orgineReporter');
    $req->execute(['id' => $_POST['idTopic'], 'orgineReporter' => $_POST['reporter']]);

}