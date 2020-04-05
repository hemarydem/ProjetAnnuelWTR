<?php
	require('includes/config.php');


	$login = htmlspecialchars($_POST['pseudo']);
	$pass = hash('sha256', $_POST['password']); // hash pour le trouver dans bdd

	$q = 'SELECT idUser,active FROM USER WHERE login = ? AND pass = ?';
	$req = $bdd->prepare($q);
	$req->execute([$login, $pass]);
	$results = $req->fetch(PDO::FETCH_ASSOC);
	$idUser = $results['idUser'];


	if(count($results) == 0){

		header('location: signIn.php?msg=Identifiants incorrects');

	}
	else{ // Utilisateur existe avec bons identifiants

		if( $results['active'] == 1){	//activé
			session_start();
			$_SESSION['pseudo'] = $login;

			//connection
			$datetime = date('Y-m-d H:i:s');
			$q = "INSERT INTO CONNECTION(dateConnection, user) VALUES(:dateConnection, :user)";
			$req = $bdd->prepare($q);
			$req->execute([
				'dateConnection' => $datetime,
				'user' => $idUser
			]);

			header('location:./');
			exit;
		}else{	//non activé
			header('location:signIn.php?msg=Compte non activé');
			exit;
		}
	}

?>
