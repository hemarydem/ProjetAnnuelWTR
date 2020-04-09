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


            if(isset($_GET['topic'])) {

                $req = $bdd->prepare('SELECT title, content, active, postDate, author FROM Topic WHERE idTopic = ?');
                $req->execute([ $_GET['topic'] ]);
                $result = $req->fetchAll(PDO::FETCH_ASSOC);
                

                echo '<h1>'. $result[0]['title'] . '</h1> <br>';
                echo' <p>' . $result[0]['content'] . '</p> <br>';
                echo' <p id="active"> Est actif ' . $result[0]['active'] . '</p> <br>';
                echo' <p>' . $result[0]['postDate'] . '</p> <br>';
                echo' <p id="author">' . $result[0]['author'] . '</p> <br>';
                echo '<p id=\'numId\'>' . $_GET['topic'] . '</p> <br>';
                echo '<button onclick=\'suppTopic()\'>supprimer Topic</button><br>';
                echo '<button onclick=\'keepTopic()\'>garder</button><br>';

                $q = 'SELECT email, login, moderator, active, userLevel, creationDate FROM USER WHERE idUser=?';
                $req = $bdd->prepare($q);
                $req->execute([$_GET['reporter']]);
                $results = $req->fetch(PDO::FETCH_ASSOC);

                echo '<p>Id: <p id="idRepoter">' . $_GET['reporter'] ;
                echo '<p>email: <p id="mail">' . $results['email'] ;
                echo '<p>login: <p id="login" >' . $results['login'] ;
                echo '<p>moderator: <p id="moderator">' . $results['moderator'] . ' </p> <button onclick="changeModerator()">change</button> </p> <br>';
                echo '<p>active: <p id="active">' . $results['active'] . '</p> <button onclick="changeactive()">activate/desactive</button> </p> <br>';;
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
