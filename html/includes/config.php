<?php

	try{
		$bdd = new PDO('mysql:host=localhost; dbname=projetAnnuel', 'root','root',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	}
	catch(Exeption $e){
		die('Error: ' . $e->getMessage);
	}

?>
