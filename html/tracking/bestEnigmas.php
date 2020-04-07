
<?php
require('../includes/config.php');


if(isset($_POST['idLevel'])){
  $idLevel = $_POST['idLevel'];
}else{
  echo '0';
  return;
}
  $stmt = $bdd->prepare('
  SELECT title, idEnigma, ROUND(AVG(PLAY.mark), 1) AS avgMark FROM ENIGMA
  INNER JOIN PLAY ON PLAY.enigma = idEnigma
  WHERE enigmaLevel = ?
  GROUP BY idEnigma
  ORDER BY AVG(PLAY.mark) DESC
  ');
  if($stmt === false) {
        echo '-1';
        return;
    }
  $stmt->execute([ $idLevel ]);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  header('Content-Type:text/xml');
  echo '<enigmas>';

    foreach ($results as $key => $value) {
      echo '<enigma>';
        echo '<title>' . $value['title'] . '</title>';
        echo '<mark>' . $value['avgMark'] . '</mark>';
        echo '<idEnigma>' . $value['idEnigma'] . '</idEnigma>';
      echo '</enigma>';

    }

  echo '</enigmas>';

?>
