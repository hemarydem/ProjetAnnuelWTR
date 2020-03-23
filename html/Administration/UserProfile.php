<?php 
require('../includes/config.php');
//echo $_GET['email'];
if(isset($_GET['email'])) {
    $q = 'SELECT email, login, moderator, working, userLevel, creationDate FROM USERS WHERE email=?';
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
        <link rel="stylesheet" type="text/css" href="https://thomerlas.online/style/css/style.css">
        <link rel="stylesheet" type="text/css" href="https://thomerlas.online/style/css/header.css">
        <link rel="icon" type="image/png" href="https://thomerlas.online/img/logo/LockYellow.png"/>
        <link rel="stylesheet" type="text/css" href="searchUserCss.css">
	</head>
	<body>
		<?php
			include('../includes/header.php');
        ?>
        <div class="profilContain">
            <h1 class="profilContainTitle">profil</h1>
            <h2 class="profilContainTitle">creationDate :</h2> <h3 id = 'userCreationDate'><?php echo $results[0]['creationDate'];?></h3>
        </div>
        <div class="profilContain" id="divMail">
            <h2 class="profilContainTitle">email </h2><h3 id = 'userEmail' class="data"> <?php echo $results[0]['email'];?></h3>
            <!--<button onclick="emailChange()">Click me</button>-->
            <form method="post" action="usersEmailProcess.php">
               <?php echo '<input type="text" name="oldEmail" placeholder="vieux mail" value="'.$results[0]['email'].'" >';?>
                <input type="text" name="newEmail" placeholder="nouveaux mail" >
                <input type="submit">
            </form>
        </div>

        <div class="profilContain" id="divLogin">
            <h2 class="profilContainTitle">login </h2> <h3 id = 'userLogin'><?php echo $results[0]['login'];?></h3>
            <!--<button onclick=pseudoChange()>changer</button>-->
            <form method="post" action="usersLoginProcess.php">
               <?php echo '<input type="text" name="mail" placeholder="vieux mail" value="'.$results[0]['email'].'" >';?>
                <input type="text" name="newLogin" placeholder="nouveaux Pseudo" >
                <input type="submit">
            </form>
        </div>

        <div class="profilContain" id="divModerator">
            <h2 class="profilContainTitle">moderator status </h2> <h3 id = 'moderatorStatus'><?php echo $results[0]['moderator'];?></h3>
            <!--<button onclick=modeStatChange()>changer</button>-->
            <form method="post" action="usersModeratorStatusProcess.php">
               <?php
               echo '<input type="text" name="mail" value="'.$results[0]['email'].'" >';?>
                <input type="submit">
            </form>
        </div>

        <div class="profilContain" id="divActivate">
            <h2 class="profilContainTitle">active </h2> <h3 id = 'moderatorStatus'><?php echo $results[0]['working'];?></h3>
            <!--<button onclick=modeStatChange()>changer</button>-->
            <form method="post" action="usersactiveProcess.php">
               <?php
               echo '<input type="text" name="mail" value="'.$results[0]['email'].'" >';?>
                <input type="submit">
            </form>
        </div>
            
        </div>
        <div class="profilContain" id="divLevel">
            <h2 class="profilContainTitle">level </h2> <h3 id = 'userLevel'><?php echo $results[0]['userLevel'];?></h3>
        </div>      
	<script src="indexOfUserProfile.js"></script>
	</body>
</html>