<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<?php
			include('includes/head.php');
		?>
		<link rel="stylesheet" href="style/css/form.css">
	</head>
	<body>

		<header >
					<a class="headerLogo flex" style="justify-content: center" href="./">
						<img src="img/logo/ThomerlasWhite.svg" alt="logo" height="130px">
						<h1>Thomerlas</h1>
					</a>
		</header>

		<main>

			<form action="signInProcess.php" method="POST">
				<h1>Connexion</h1>
				<?php
					if(isset($_GET['msg'])){
						echo '<h2 class="msg">' . htmlspecialchars($_GET['msg']) . '</h2>';
					}
				?>
				<section>
					<input type="text" name="pseudo" placeholder=" Pseudo"><br>
					<input type="password" name="password" placeholder=" Mot de passe"><br>
				</section>
				<section class="formBottom">
					<input class="formButton" type="submit" name="submit" value="Connexion"><br>
					<a href="signUp.php">Pas de compte ? S'inscrire</a><br>
					<a href="forgotPwd.php">Mot de passe oublié</a>
				</section>
			</form>

		</main>


	</body>
</html>
