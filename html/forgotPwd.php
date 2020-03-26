<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<?php include('includes/head.php'); ?>
	</head>
	<body>
		<?php include('includes/header.php'); ?>
		<main>
            <h1>mot de passe oublié</h1>
            <p>Si vous avez oublié votre mot de passe rentrer votre adresse ci-dessous et cliquer sur envoyer</p>
            <form method="POST" action="forgotPwdProcess.php">
                <input type="text" name="login" placeholder="Votre pseudo">
                <input type="submit" value="envoyer">
            </form>
		</main>
	</body>
</html>
