
<?php
require('includes/config.php');
session_start();

if( !isset( $_SESSION['pseudo'] ) || $_SESSION['pseudo'] != 'administrateur' ){
  header('location:./');
  exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('includes/head.php') ?>
</head>
<body>
  <?php
      include('includes/header.php');
  ?>
    <main>

        <section>
          <div class="topPlayers">
            <h1>Meilleurs Joueurs</h1>
              <table>
                <thead>
                  <tr>
                    <th>Pseudo</th>
                    <th>Points</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                    $q = 'SELECT login,points FROM USER ORDER BY points DESC LIMIT 5';
                    $req = $bdd->query($q);
                    $results = $req->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($results as $key => $value) {
                      echo '
                        <tr>
                          <td> ' . $value['login'] . ' </td>
                          <td> ' . $value['points'] . ' </td>
                        </tr>
                      ';
                    }

                  ?>
                </tbody>
              </table>

          </div>
        </section>
        <section>
          <div class="connectionPerDay">
            <h1>Nombre de connexions par jour</h1>

            <table style="display: block;width: 400px;height: 300px; overflow: scroll;">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>connexions</th>
                </tr>
              </thead>
              <tbody>
                <?php

                  $q = 'SELECT CAST(dateConnection AS DATE) AS date, COUNT(idConnection) AS connections FROM CONNECTION GROUP BY date ORDER BY date DESC';
                  $req = $bdd->query($q);
                  $results = $req->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($results as $key => $value) {
                    echo '
                      <tr>
                        <td> ' . $value['date'] . ' </td>
                        <td> ' . $value['connections'] . ' </td>
                      </tr>
                    ';
                  }

                ?>
              </tbody>
            </table>

          </div>
        </section>
        <section>
          <div class="enigmasPlayedPerDay">
            <h1>Nombre d'énigmes jouées par jour</h1>

            <table style="display: block;width: 400px;height: 300px; overflow: scroll;">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>énigmes jouées</th>
                </tr>
              </thead>
              <tbody>
                <?php

                  $q = 'SELECT CAST(datePlay AS DATE) AS date, COUNT(user) AS played FROM PLAY GROUP BY date ORDER BY date DESC';
                  $req = $bdd->query($q);
                  $results = $req->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($results as $key => $value) {
                    echo '
                      <tr>
                        <td> ' . $value['date'] . ' </td>
                        <td> ' . $value['played'] . ' </td>
                      </tr>
                    ';
                  }

                ?>
              </tbody>
            </table>

          </div>
        </section>
    </main>


</body>
</html>
