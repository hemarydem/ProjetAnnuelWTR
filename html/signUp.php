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

			<form id="formSignUp" name="signUp" method="POST" action="signUpProcess.php" >
				<div>
				
					<h1>Inscription</h1>
					
					
					<h3 id="msg">
						<?php
							if(isset($_GET['msg'])){
								echo htmlspecialchars($_GET['msg']);
							}
						?>
					</h3>
					<section id="inputsSignUp">
						<input type="text" name="pseudo" placeholder=" Pseudo" autocomplete="on" required <?php echo isset( $_GET['pseudo'] ) ? "value=" . htmlspecialchars($_GET['pseudo']) : "" ?> >
						<small class="rules" id="indicationPseudo">* Le pseudo doit faire entre 5 et 16 caractères</small>
						<input type="email" name="email" placeholder=" Email" autocomplete="on" required <?php echo isset( $_GET['email'] ) ? "value=" . htmlspecialchars($_GET['email']) : "" ?>>
						<input type="password" name="password" placeholder=" Mot de passe" autocomplete="on" required>
						<small class="rules" id = "indicationPwd">* Le mot de passe doit contenir au moins 1 majuscule, 1 chiffre et 1 caractère spécial</small>
						<input type="password" name="password2" placeholder=" Confirmez le mot de passe" autocomplete="on" required>
					</section>
				</div>
				
				<div>
					<section id="captchaZone">
						<?php include('includes/captcha.php') ?>
						</div>
					</section>

					<section class="formBottom">
						<input class="formButton" type="submit" name="submit" value="S'inscrire"><br>
						<a href="signIn.php">Déjà un compte ? Se connecter</a>
					</section>
				</div>
				
				

				

			</form>
		</main>
		<footer>
		</footer>
		
		<script type="text/javascript" src="script/captcha.js"></script>
		<script type="text/javascript" src="script/signUp.js"></script>
	</body>
</html>
