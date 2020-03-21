<?php 
require('../includes/config.php');
echo $_GET['email'];
if(isset($_GET['email'])) {
    $q = 'SELECT email, login, moderator, working, userLevel FROM USERS WHERE email=?';
    $req = $bdd->prepare($q);
    $req->execute(array($_GET['email']));
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
}else{
    header('location: searchUser.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Liste utilisateurs</title>
		<meta charset="utf-8">
	</head>
	<body>
		<?php
			include('../includes/header.php');
			include('../includes/adminNav.php');
		?>
        <h1>profil</h1>
        <div id="divMail">
            <h2>email :</h2><h3 id = 'userEmail'> <?php echo $results[0]['email'];?></h3>
            <input type="text" id="newMail" placeholder="nouvelle adresse mail"> 
            <button onclick=emailChange()>changer</button>
            <h1>test</h1>
            <form method="post" action="usersEmailProcess.php">
                <input type="text" name="oldEmail" placeholder="vieux">
                <input type="text" name="newemail" placeholder="nouveaux">
                <input type="submit">
            </form>
        </div>
        <div id="divLogin">
            <h2>login :</h2> <h3 id = 'userLogin'><?php echo $results[0]['login'];?></h3>
            <input type="text" id="newPseudo" placeholder="nouveau Pseudo"> 
            <button onclick=pseudoChange()>changer</button>
        </div>
        <div id="divModerator">
            <h2>moderator status :</h2> <h3 id = 'moderatorStatus'><?php echo $results[0]['moderator'];?></h3>
            <button onclick=modeStatChange()>changer</button>
        </div>
        <h2>creationDate :</h2> <h3 id = 'userCreationDate'><?php echo $results[0]['creationDate'];?></h3>
        <div id="divActivate">
            <h2>activate :</h2> <h3 id = 'userActiveState'><?php echo $results[0]['working'];?></h3>
            <input type="text" id="" placeholder="nouvelle adresse mail"> 
            <button onclick=turnOnOff()>changer</button>
        </div>
        <div id="divLevel">
            <h2>level :</h2> <h3 id = 'userLevel'><?php echo $results[0]['userLevel'];?></h3>
        </div>      
	<script src="indexOfUserProfile.js"></script>
	</body>
</html>