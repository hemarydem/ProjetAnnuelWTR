<?php
	session_start();
	require('../../includes/config.php');
	//
	//
	//
	//
	//
	//
	/*___Trim des inputs____________________________*/
	$_POST['pseudo'] = trim($_POST['pseudo']);
	$_POST['email'] = trim($_POST['email']);
	$_POST['password'] = trim($_POST['password']);
	/*______________________________________________*/
	//
	//
	//
	//
	//
	//
	/*___verification des longueurs du pseudo et de mdp____________________________*/

	//pseudo
	if(!isset($_POST['pseudo'])){
		header('Location:signUp.php?msg=Pseudo vide');
		exit;
	}
	elseif(strlen($_POST['pseudo']) < 5){
		header('Location:signUp.php?msg=Pseudo trop court');
		exit;
	}

	elseif(strlen($_POST['pseudo']) > 16){
		header('Location:signUp.php?msg=Pseudo trop long');
		exit;
	}


	//Mot de passe
	if(!isset($_POST['password'])){
		header('Location:signUp.php?msg=Mot de passe vide');
		exit;
	}
	elseif(strlen($_POST['password']) < 5){
		header('Location:signUp.php?msg=Mot de passe trop court');
		exit;
	}
	elseif(strlen($_POST['password']) > 20){
		header('Location:signUp.php?msg=Mot de passe trop long');
		exit;
	}
/*______________________________________________*/
//
//
//
//
//
//
/*___Critères de mot de passe_________________________________________*/
//	Au moins:
//	1 Majuscule
//	1 chiffre
//	1 caractère spécial

//protection des caractères spéciaux: un \ devant
$specialCars = preg_quote('!"#$%&\'()*+,-./:;<=>?@[\]^_`{|}~');

	if( !preg_match("#[A-Z]#", $_POST['password']) ){
		header('Location:signUp.php?msg=Le mot de passe doit contenir au moins une majuscule');
		exit;
	}
	elseif ( !preg_match("#[0-9]#", $_POST['password']) ) {
		header('Location:signUp.php?msg=Le mot de passe doit contenir au moins un chiffre');
		exit;
	}
	elseif ( !preg_match("#[$specialCars]#", $_POST['password']) ) {
		header('Location:signUp.php?msg=Le mot de passe doit contenir au moins un caractère spécial');
		exit;
	}


	if(!isset($_POST['password2'])){
		header('Location:signUp.php?msg=Veuillez confirmer votre mot de passe');
		exit;
	}
	elseif ($_POST['password2'] != $_POST['password']) {
		header('Location:signUp.php?msg=Les deux mots de passes sont différents');
		exit;
	}
/*______________________________________________*/
//
//
//
//
//
//
/*___verification de l'email_____________________________________________*/
	// Format email
	if(!isset($_POST['email']) ){
		header('Location:signUp.php?msg=Email vide');
		exit;
	}
	else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		header('Location:signUp.php?msg=Email non valide');
		exit;
	}
/*______________________________________________*/

//
//
//
//
//
//
/*___Si l'email ou le pseudo ne sont pas déjà utilisés____________________*/

	//Verifier que l'email n'est pas déjà prit
	$q = 'SELECT email FROM USERS WHERE email = ?';
	$req = $bdd->prepare($q);
	$req->execute([$_POST['email']]);
	$results = $req->fetchAll(PDO::FETCH_ASSOC);
	if(count($results) > 0){
		header('Location:signUp.php?msg=Email déjà prit');
		exit;
	}

	//Verifier que le pseudo n'est pas déjà prit
	$q = 'SELECT email FROM USERS WHERE login = ?';
	$req = $bdd->prepare($q);
	$req->execute([$_POST['pseudo']]);
	$results = $req->fetchAll(PDO::FETCH_ASSOC);
	if(count($results) > 0){
		header('Location:signUp.php?msg=Pseudo déjà prit');
		exit;
	}
/*______________________________________________*/
//
//
//
//
//
//
/*___CAPTCHA_____________________________________________________________*/
	if($_SESSION['captcha'] == false){
		header('Location:signUp.php?msg=Vous êtes un robot');
		exit;
	}
/*_______________________________________________*/
//
//
//
//
//
//
/*___variables à envoyer à la BDD________________________________________*/
	$login = htmlspecialchars($_POST['pseudo']); // empèche l'injection de JS -> faille XSS
	$email = $_POST['email'];
	$pass =  hash('sha256', $_POST['password'] );  // Hashage avant insertion en bdd
	$moderator = 0;
	$working = 0;
	$userLevel = 'beginner';
	$date = date('Y-m-d');
	$token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
/*_______________________________________________*/
//
//
//
//
//
//
/*___Requête SQL_________________________________________________________*/
	$q = 'INSERT INTO USERS (email,login,pass,moderator,working,userLevel,creationDate,token) VALUES (:email,:login,:pass,:moderator,:working,:userLevel,:creationDate,:token)';
	$req = $bdd->prepare($q);
	$req->execute([
		'email' => $email,
		'login' => $login,
		'pass' => $pass,
		'moderator' => $moderator,
		'working' => $working,
		'userLevel' => $userLevel,
		'creationDate' => $date,
		'token' => $token
	]);
/*_______________________________________________*/
//
//
//
//
//
//
/*___Envoie du mail_________________________________________________________*/
include('../../includes/mail.php');

/*_______________________________________________*/
//
//
//
//
//
//
/*___Message____________________________*/
	header('Location: ../signIn/signIn.php?msg=Un email vous a été envoyé');
	exit;
/*_______________________________________________________*/
//
//
//
//
//
//
