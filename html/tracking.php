
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
              <div class="slideContainer">
                <input id="slideTopPlayers" type="range" min="1" max="20" value="5">
                <label id="nbTop" for="slideTopPlayers"></label>
              </div>
              <table>
                <thead>
                  <tr>
                    <th>Pseudo</th>
                    <th>Points</th>
                  </tr>
                </thead>
                <tbody id="bestPlayersTable">

                </tbody>
              </table>

          </div>
        </section>
        <section>
          <div class="bestEnigmasPerLevel">
            <h1>Les énigmes les mieux notées par niveau</h1>

            <select id="levels">
              <?php
                $req = $bdd->query('SELECT name,idLevel FROM LEVEL');
                $results = $req->fetchAll(PDO::FETCH_ASSOC);

                foreach ($results as $key => $value) {
                  echo '<option value=' . $value['idLevel'] .'>' . $value['name'] . '</option>';
                }
              ?>
            </select>

            <table>
              <thead>
                <tr>
                  <th>Titre</th>
                  <th>Note</th>
                </tr>
              </thead>
              <tbody id="bestEnigmasTable">

              </tbody>
            </table>

          </div>
        </section>
        <section>
          <div class="connectionPerDay">
            <h1>Nombre de connexions par jour</h1>

            <canvas id="graphConnectionsPerDay"></canvas>

          </div>
        </section>
        <section>
          <div class="enigmasPlayedPerDay">
            <h1>Nombre d'énigmes jouées par jour</h1>

            <canvas id="graphEnigmasPlayedPerDay"></canvas>

          </div>
        </section>
        <section>
          <div class="enigmasSolvedPerDay">
            <h1>Nombre d'énigmes résolues par jour</h1>

            <canvas id="graphEnigmasSolvedPerDay"></canvas>

          </div>
        </section>
    </main>

    <script src="tracking/bestEnigmas.js"></script>
    <script src="tracking/topPlayers.js"></script>
    <script src="tracking/graphics.js"></script>
    <script src='tracking/connectionPerDay.php'></script>
    <script src="tracking/enigmasPlayedPerDay.php"></script>
    <script src="tracking/enigmasSolvedPerDay.php"></script>
</body>
</html>
