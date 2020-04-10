<?php
require('includes/config.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('includes/head.php') ?>
</head>
<body>
    <?php
        include('includes/header.php');
    ?>
    <main>
        <?php


            if(isset($_GET['enigma'])) {

                $req = $bdd->prepare('SELECT title, description, active,trick,profilePicture, gain, creationDate, author FROM ENIGMA WHERE idEnigma = ?');
                $req->execute([ $_GET['enigma'] ]);
                $result = $req->fetchAll(PDO::FETCH_ASSOC);
                

                echo '<h1>'. $result[0]['title'] . '</h1> <br>';
                echo' <p>' . $result[0]['description'] . '</p> <br>';
                echo' <p id="active"> Est actif ' . $result[0]['active'] . '</p> <br>';
                echo' <p>' . $result[0]['creationDate'] . '</p> <br>';
                echo' <p id="author">' . $result[0]['author'] . '</p> <br>';
                echo '<p>.id :<p id=\'numId\'>' . $_GET['enigma'] . '</p> </p><br>';
                echo '<button onclick=\'suppEnigma()\'>supprimer enigme</button><br>';
                echo '<button onclick=\'keepEnigma()\'>garder</button><br>';
                
                $q = 'SELECT email, login, moderator, active, userLevel, creationDate FROM USER WHERE idUser=?';
                $req = $bdd->prepare($q);
                $req->execute([$result[0]['author']]);
                $results = $req->fetch(PDO::FETCH_ASSOC);
                echo '<h1>auteru de l\'enigme</h1>';
                echo '<p>Id: <p>' . $_GET['reporter'].'</p>';
                echo '<p>email: <p id = "emailBadUser">' . $results['email']. '</p>';
                echo '<p>login: <p>' . $results['login'].'</p>' ;
                echo '<p>moderator: <p>' . $results['moderator'].'</p>';
                echo '<p>active: <p>' . $results['active'] . '</p> </p><br>';;
                echo '<p>level: <p>' . $results['userLevel'] . '</p> </p> <br>';
                echo '<p>Creation Date: <p id="date">' . $results['creationDate'] . '</p> </p> <br>';

                $q = 'SELECT email, login, moderator, active, userLevel, creationDate FROM USER WHERE idUser=?';
                $req = $bdd->prepare($q);
                $req->execute([$_GET['reporter']]);
                $results = $req->fetch(PDO::FETCH_ASSOC);
                echo '<h1>la personne qui a signaler</h1>';
                echo '<p>Id: <p id="idRepoter">' . $_GET['reporter'] ;
                echo '<p>email: <p id="mail">' . $results['email'] ;
                echo '<p>login: <p id="login" >' . $results['login'] ;
                echo '<p>moderator: <p id="moderator">' . $results['moderator'] . ' </p> <button onclick="changeModerator()">change</button> </p> <br>';
                echo '<p>active: <p>' . $results['active'] . '</p> <button onclick="changeactive()">activate/desactive</button> </p> <br>';;
                echo '<p>level: <p id="level">' . $results['userLevel'] . '</p> </p> <br>';
                echo '<p>Creation Date: <p id="date">' . $results['creationDate'] . '</p> </p> <br>';
            }else{
                header('location: searchUser.php');
                exit;
            }
        ?>
    </main>
    <script src="script/profilAdmin.js"></script>
</body>
</html>