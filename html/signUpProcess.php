<?php
	session_start();
	require('includes/config.php');
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
		header('Location:signUp.php?msg=Pseudo vide&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
		exit;
	}
	elseif(strlen($_POST['pseudo']) < 5){
		header('Location:signUp.php?msg=Pseudo trop court&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
		exit;
	}

	elseif(strlen($_POST['pseudo']) > 16){
		header('Location:signUp.php?msg=Pseudo trop long&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
		exit;
	}


	//Mot de passe
	if(!isset($_POST['password'])){
		header('Location:signUp.php?msg=Mot de passe vide&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
		exit;
	}
	elseif(strlen($_POST['password']) < 5){
		header('Location:signUp.php?msg=Mot de passe trop court&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
		exit;
	}
	elseif(strlen($_POST['password']) > 20){
		header('Location:signUp.php?msg=Mot de passe trop long&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
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
		header('Location:signUp.php?msg=Le mot de passe doit contenir au moins une majuscule&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
		exit;
	}
	elseif ( !preg_match("#[0-9]#", $_POST['password']) ) {
		header('Location:signUp.php?msg=Le mot de passe doit contenir au moins un chiffre&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
		exit;
	}
	elseif ( !preg_match("#[$specialCars]#", $_POST['password']) ) {
		header('Location:signUp.php?msg=Le mot de passe doit contenir au moins un caractère spécial&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
		exit;
	}


	if(!isset($_POST['password2'])){
		header('Location:signUp.php?msg=Veuillez confirmer votre mot de passe&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
		exit;
	}
	elseif ($_POST['password2'] != $_POST['password']) {
		header('Location:signUp.php?msg=Les deux mots de passes sont différents&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
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
		header('Location:signUp.php?msg=Email vide&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
		exit;
	}
	else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		header('Location:signUp.php?msg=Email non valide&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
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
	$q = 'SELECT email FROM USER WHERE email = ?';
	$req = $bdd->prepare($q);
	$req->execute([$_POST['email']]);
	$results = $req->fetchAll(PDO::FETCH_ASSOC);
	if(count($results) > 0){
		header('Location:signUp.php?msg=Email déjà prit&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
		exit;
	}

	//Verifier que le pseudo n'est pas déjà prit
	$q = 'SELECT email FROM USER WHERE login = ?';
	$req = $bdd->prepare($q);
	$req->execute([$_POST['pseudo']]);
	$results = $req->fetchAll(PDO::FETCH_ASSOC);
	if(count($results) > 0){
		header('Location:signUp.php?msg=Pseudo déjà prit&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
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
		header('Location:signUp.php?msg=Vous êtes un robot&pseudo='.$_POST['pseudo'].'&email='.$_POST['email']);
		exit;
	}
/*_______________________________________________*/
//
//
//
/*_______________________________________________*/
	$q = 'SELECT idLevel FROM LEVEL WHERE name = ?';
	$request = $bdd->prepare($q);
	$request->execute(['beginner']);
	$result =  $req->fetch(PDO::FETCH_ASSOC);
	$userLevel = $result['idLevel'];

/*_______________________________________________*/
//
//
//
/*___variables à envoyer à la BDD________________________________________*/
	$login = htmlspecialchars($_POST['pseudo']); // empèche l'injection de JS -> faille XSS
	$email = $_POST['email'];
	$pass =  hash('sha256', $_POST['password'] );  // Hashage avant insertion en bdd
	$moderator = 0;
	$active = 0;
	$date = date('Y-m-d');
	$token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
	$points = 0;
/*_______________________________________________*/
//
//
//
/*_________________traitemant image_____________________________________*/
	if( $_FILES['image']['type'] != NULL ){
	
		//verifiaction du poids du fichier
		$maxsize = 1024 * 1024; // 1Mo
		$acceptable = [
		  'image/jpeg',
		  'image/jpg',
		  'image/png',
		  'image/gif'
		];
		
		if(!in_array( $_FILES['image']['type'], $acceptable ) ){
			header('Location:signUp.php?msg=Fichier invalide');
			exit;
		}
		elseif($_FILES['image']['size'] > $maxsize){
		  header('Location:signUp.php?msg=Fichier trop volumineux');
			exit;
		}
	}
	
/*____________________________________________________________________ */
//
//
//
/*___Requête SQL_________________________________________________________*/
	$q = 'INSERT INTO USER (email,login,pass,moderator,active,userLevel,creationDate,token,points) VALUES (:email,:login,:pass,:moderator,:active,:userLevel,:creationDate,:token,:points)';
	$req = $bdd->prepare($q);
	$req->execute([
		'email' => $email,
		'login' => $login,
		'pass' => $pass,
		'moderator' => $moderator,
		'active' => $active,
		'userLevel' => $userLevel,
		'creationDate' => $date,
		'token' => $token,
		'points' => $points
	]);
/*_______________________________________________*/
//
//
//
/*___Requête SQL_________________________________________________________*/

if( $_FILES['image']['type'] != NULL ){
	//telecharger l'image
	//chemin d'enregistrement
	$path = 'img/profile/';
	if(!file_exists($path)){
	mkdir($path, 0777, true);
}

	//renomer l'image avec l'id de l'utilisateur et la date
	$imagename = $_FILES['image']['name'];
	$temp = explode('.', $imagename);
	$extension = end($temp);
	$timestamp = time();
	$imagename = 'image_profile-' . $login . '-' . $timestamp . '.' . $extension;

	//déplacer l'image dans le dossier img/profile/
	$pathImage = $path . $imagename;
	move_uploaded_file( $_FILES['image']['tmp_name'], $pathImage );

	//inserer le chemin de l'image dans la bdd
	if($_FILES['image']['name'] != NULL){
		$q = 'UPDATE USER SET profilePicture = ? WHERE email = ?';
		$req = $bdd->prepare($q);
		$req->execute([$imagename, $email ]);
	}
}
/*_______________________________________________*/
//
//
//
/*___Envoie du mail_________________________________________________________*/
include('includes/mail.php');

/*_______________________________________________*/
//
//
//
//
//
//
/*___Message____________________________*/
	header('Location: signIn.php?msg=Un email vous a été envoyé');
	exit;
/*_______________________________________________________*/
//
//
//
//
//
//
