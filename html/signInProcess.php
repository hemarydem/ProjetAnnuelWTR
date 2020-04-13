<?php
	require('includes/config.php');
	$datetimeFlag = date('Y-m-d');// for line 20

	$login = htmlspecialchars($_POST['pseudo']);
	$pass = hash('sha256', $_POST['password']); // hash pour le trouver dans bdd

	$q = 'SELECT idUser,active,FLAGBAN FROM USER WHERE login = ? AND pass = ?';
	$req = $bdd->prepare($q);
	$req->execute([$login, $pass]);
	$results = $req->fetch(PDO::FETCH_ASSOC);
	$idUser = $results['idUser'];


	if(count($results) == 0){

		header('location: signIn.php?msg=Identifiants incorrects');

	}
	if($results['FLAGBAN'] > $datetimeFlag) { 
		header('location: signIn.php?msg=vous ètes bannis');
	}
	else{ // Utilisateur existe avec bons identifiants

		if( $results['active'] == 1){	//activé
			session_start();
			$_SESSION['pseudo'] = $login;

			//connection
			$datetime = date('Y-m-d H:i:s');

			$ipLength = strlen( $_SERVER['REMOTE_ADDR'] ); // length max ipv6 = 39.  But ipv4 scoring ipv6 length max 45
			$ipUser = $ipLength < 0 || $ipLength > 45 ? 0 : $_SERVER['REMOTE_ADDR'];
			$q = "INSERT INTO CONNECTION(dateConnection, ipUser, user) VALUES(:dateConnection, :ipUser, :user)";
			$req = $bdd->prepare($q);
			$req->execute([
				'dateConnection' => $datetime,
				'ipUser' => $ipUser,
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
