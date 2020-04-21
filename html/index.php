<?php
	session_start();
	require('includes/config.php');

	if( !isset( $_SESSION['pseudo'] ) ){
		$idLevel = 1;
	}else{
		$q = '
			SELECT idLevel FROM LEVEL
			INNER JOIN USER ON USER.login = ?
			WHERE threshold <= USER.points
			ORDER BY threshold DESC
			LIMIT 1
		';
		$req = $bdd->prepare($q);
		$req->execute([ $_SESSION['pseudo'] ]);
		$idLevel = $req->fetch(PDO::FETCH_ASSOC)['idLevel'];
	}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<?php include('includes/head.php'); ?>
	</head>
	<body>
		<?php include('includes/header.php'); ?>
		<main>
			<section>
				<a href="createEnigma.php">Créer une énigme</a>
			</section>
			<section>
				<p>Filtres</p>
			</section>

			<?php


			$q = '
			SELECT idEnigma,title,description,enigmaLevel, ROUND(AVG(PLAY.mark) ,1) AS mark FROM ENIGMA
				LEFT JOIN PLAY ON enigma = idEnigma
				WHERE enigmaLevel = ?
				and active = 1
				GROUP BY idEnigma
				ORDER BY creationDate DESC
			';
			$req = $bdd->prepare($q);
			$req->execute([ $idLevel ]);
			$results = $req->fetchAll(PDO::FETCH_ASSOC);

			for ($i=0; $i < count($results); $i++) {
				echo "<section class='enigmaContainer flex'>";

				echo '<img src="img/enigma/defaultPicture.png" alt="logo enigma" height="180px"/>';

				echo "<div id =" . $results[$i]['idEnigma'] . " onclick=enigmaLink(". $results[$i]['idEnigma'] .")>";

					echo "<h1>" . $results[$i]['title'] . "</h1><br>";
					echo "<p>" . $results[$i]['description'] . "</p>";
					echo $results[$i]['mark'] == NULL ? 'Enigme inédite !': $results[$i]['mark'];
					echo '<p><a href="reportEnigmaForm.php?idEnigma=' . $results[$i]['idEnigma'] . '">Signaler</a></p>';
				echo "</div>";

				echo "</section>";

			}

			?>


		</main>
		<script src="script/selectIndex.js"></script>
	</body>
</html>
