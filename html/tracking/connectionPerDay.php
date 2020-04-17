<?php
require('../includes/config.php');
header('Content-Type: text/javascript');


  $q = 'SELECT CAST(dateConnection AS DATE) AS date, COUNT(idConnection) AS connections FROM CONNECTION GROUP BY date ORDER BY date DESC';
  $req = $bdd->query($q);
  $results = $req->fetchAll(PDO::FETCH_ASSOC);
  $i = 0;
  foreach ($results as $key => $value) {

    echo "xArray[" . $i . "] = '" . $value['date'] . "'\n";
    echo "yArray[" . $i . "] = '" . $value['connections'] . "'\n";

    $i++;
  }
?>

trackingCanvas('graphConnectionsPerDay',xArray,yArray);
