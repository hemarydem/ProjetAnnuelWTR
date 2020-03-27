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
				
			<h1>Inscription</h1>

				<div>


					<div>

						<h3 id="msg">
							<?php
								if(isset($_GET['msg'])){
									echo htmlspecialchars($_GET['msg']);
								}
							?>
						</h3>
						<section id="inputsSignUp">
							<img id="fieldImg" src="img/profile/default-user-image.png" alt="previewImg">
							<label for="inputImg">Choisir une image</label>
							<input id="inputImg" type="file" accept="image/png, image/jpeg, image/gif" >
							<label for="">Pseudo</label>
							<input type="text" name="pseudo" placeholder="Entre 5 et 16 caractères" autocomplete="on" required <?php echo isset( $_GET['pseudo'] ) ? "value=" . htmlspecialchars($_GET['pseudo']) : "" ?> >
							<label for="">Email</label>
							<input type="email" name="email" placeholder=" Email" autocomplete="on" required <?php echo isset( $_GET['email'] ) ? "value=" . htmlspecialchars($_GET['email']) : "" ?>>
							<label for="">Mot de passe</label>
							<input type="password" name="password" placeholder="1 majuscule 1 chiffre et 1 caractère spécial" autocomplete="on" required>
							<label for="">Confirmation du mot de passe</label>
							<input type="password" name="password2" placeholder=" Confirmez le mot de passe" autocomplete="on" required>
						</section>
					</div>
					
					<div>
						<section id="captchaZone">
							<?php include('includes/captcha.php') ?>
							</div>
						</section>
					</div>
				</div>

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
