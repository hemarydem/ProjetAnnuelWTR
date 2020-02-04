<?php

try{
    $bdd = new PDO('mysql:host=localhost:8889;dbname=EspaceMembre', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
 }
 catch(Exeption $e){
    die('Error: ' . $e->getMessage);
} 
	$mail = $_POST['mail'];
	$lastName = $_POST['lastName'];
	$firstName = $_POST['firstName'];
	$country = $_POST['country'];
	$userName = $_POST['userName'];
	$q= 'INSERT INTO Member (mail,lastName,firstName, country,userName) VALUES (:val1,:val2,:val3,:val4,:val5)';
 	$req = $bdd->prepare($q);
	$req->execute( ['val1' => $mail , 'val2' => $lastName, 'val3' => $firstName, 'val4' => $country, 'val5' => $userName] );
?>