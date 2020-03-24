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
		<link rel="stylesheet" href="style/css/captcha.css">
	</head>
	<body>

		<header >
					<a class="headerLogo flex" style="justify-content: center" href="./">
						<img src="img/logo/ThomerlasWhite.svg" alt="logo" height="130px">
						<h1>Thomerlas</h1>
					</a>
		</header>

		<main>

			<form name="signUp" method="POST" action="signUpProcess.php">
				<h1>Inscription</h1>
				<h3 id="msg">
					<?php
						if(isset($_GET['msg'])){
							echo htmlspecialchars($_GET['msg']);
						}
					?>
				</h3>
				<section>
					<input type="text" name="pseudo" placeholder=" Pseudo" required><br>
					<input type="email" name="email" placeholder=" Email" required><br>
					<input type="password" name="password" placeholder=" Mot de passe" required><br>
					<input type="password" name="password2" placeholder=" Confirmez le mot de passe"  required><br>
				</section>

				<section id="captchaZone">
					<?php include('includes/captcha.php') ?>
					</div>
				</section>

				<section class="formBottom">
					<input class="formButton" type="submit" name="submit" value="S'inscrire"><br>
					<a href="signIn.php">Déjà un compte ? Se connecter</a>
				</section>

			</form>
		</main>
		<footer>
		</footer>

		<script type="text/javascript" src="script/captcha.js"></script>
		<script type="text/javascript" src="script/signUp.js"></script>
	</body>
</html>
