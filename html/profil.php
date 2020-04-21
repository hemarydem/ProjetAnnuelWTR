<?php
    include('includes/config.php');
    session_start();
    $req = $bdd->prepare('SELECT USER.moderator, USER.userLevel, USER.points, USER.COUNTERBAN 
    FROM USER 
    WHERE idUser = ? ');
    $req->execute([ $_SESSION['pseudo'] ]);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    $q = '
        SELECT idLevel FROM LEVEL
        INNER JOIN USER ON USER.login = ?
        WHERE threshold <= USER.points
        ORDER BY threshold DESC
        LIMIT 1
        ';
        $req = $bdd->prepare($q);
        $req->execute([ $_SESSION['pseudo'] ]);
        $Level = $req->fetch(PDO::FETCH_ASSOC)['idLevel'];
?>
	
    <!DOCTYPE html>
<html lang="en">
<head>
    <?php include('includes/head.php') ?>
    <link rel="stylesheet" type="text/css" href="style/css/creatLevel.css">
</head>
<body>
    <?php
        include('includes/header.php');
    ?>
<body>
<main>
<h1><?php $_SESSION['pseudo'];?></h1>
<?php
echo '<img src="'.$result['profilePicture'].'">';
?>
<div>
<h2>niveau</h2>
<p><?php $Level ;?></p>
</div>
</main>    
</body>
</html>