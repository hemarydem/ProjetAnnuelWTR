<?php

	try{
		$bdd = new PDO('mysql:host=localhost; dbname=projetAnnuel', 'esgi','EE7tM6d9bd5R',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	}
	catch(Exeption $e){
		die('Error: ' . $e->getMessage);
	}

?>
