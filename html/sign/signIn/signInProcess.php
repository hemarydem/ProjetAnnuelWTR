<?php
	require('../../includes/config.php');


	$login = htmlspecialchars($_POST['pseudo']);
	$pass = hash('sha256', $_POST['password']); // hash pour le trouver dans bdd

	$q = 'SELECT email,working FROM USERS WHERE login = ? AND pass = ?';
	$req = $bdd->prepare($q);
	$req->execute([$login, $pass]);
	$results = $req->fetchAll(PDO::FETCH_ASSOC);


	if(count($results) == 0){

		header('location: signIn.php?msg=Identifiants incorrects');

	}
	else{ // Utilisateur existe avec bons identifiants

		if( $results[0]['working'] == 1){	//activé
			session_start();
			$_SESSION['pseudo'] = $login;
			header('location:http://localhost:8888/html/index.php');
			exit;
		}else{	//non activé
			header('location:signIn.php?msg=Compte non activé');
			exit;
		}
	}

?>
