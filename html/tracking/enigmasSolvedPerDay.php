
<?php
require('../includes/config.php');
header('Content-Type: text/javascript');


  $q = 'SELECT CAST(datePlay AS DATE) AS date, COUNT(user) AS played FROM PLAY WHERE solves = 1 GROUP BY date ORDER BY date DESC';
  $req = $bdd->query($q);
  $results = $req->fetchAll(PDO::FETCH_ASSOC);
  $i = 0;
  foreach ($results as $key => $value) {

    echo "xArray[" . $i . "] = '" . $value['date'] . "'\n";
    echo "yArray[" . $i . "] = '" . $value['played'] . "'\n";

    $i++;
  }

?>


trackingCanvas('graphEnigmasSolvedPerDay',xArray,yArray);
