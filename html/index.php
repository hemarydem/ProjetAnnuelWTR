<?php
	session_start();
	require('includes/config.php');
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


			$q = 'SELECT title,description FROM ENIGMA';
			$req = $bdd->query($q);
			$results = $req->fetchAll(PDO::FETCH_ASSOC);

			for ($i=0; $i < count($results); $i++) {
				echo "<section class='enigmaContainer flex'>";

				echo '<img src="img/enigma/defaultPicture.png" alt="logo enigma" height="180px"/>';

				echo "<div>";

					echo "<h1>" . $results[$i]['title'] . "</h1><br>";
					echo "<p>" . $results[$i]['description'] . "</p>";

				echo "</div>";

				echo "</section>";

			}

			?>


		</main>
	</body>
</html>
