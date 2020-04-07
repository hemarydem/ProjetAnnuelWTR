
<?php
require('../includes/config.php');

if( isset($_GET['nbTop']) && (int)$_GET['nbTop'] > 0 ){
  $nbTop = $_GET['nbTop'];
}else{

  echo '0';
  return;
}
  $stmt = $bdd->prepare('SELECT login,points FROM USER ORDER BY points DESC LIMIT :nbTop');
  if($stmt === false) {
        echo '-1';
        return;
    }
  $stmt->bindValue(':nbTop', $nbTop, PDO::PARAM_INT);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  header('Content-Type:text/xml');
  echo '<players>';

    foreach ($results as $key => $value) {
      echo '<player>';
        echo '<login>' . $value['login'] . '</login>';
        echo '<points>' . $value['points'] . '</points>';
      echo '</player>';
    }

  echo '</players>';

?>
