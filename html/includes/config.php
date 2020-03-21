<?php
	//	PENSER À DÉCOMMENTER CE PDO POUR INTÉGRATION SUR SERVEUR
	//try{
	//	$bdd = new PDO('mysql:host=localhost; dbname=projetAnnuel', 'esgi','EE7tM6d9bd5R',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	//}
	//catch(Exeption $e){
	//	die('Error: ' . $e->getMessage);
	//}

	//PDO LOCAL
	if(session_id() == '') {
		session_start();
	}
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=projetAnnuel', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	}catch(Exception $e){
		die('Erreur : ' . $e->getMessage());
	}
?>
