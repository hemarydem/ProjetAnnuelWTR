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


            if(isset($_GET['email'])) {
                $q = 'SELECT email, login, moderator, active, userLevel, creationDate FROM USER WHERE email=?';
                $req = $bdd->prepare($q);
                $req->execute([ $_GET['email'] ]);
                $results = $req->fetchAll(PDO::FETCH_ASSOC);

                if( count( $results ) == 0 ){
                    header('Location: admin.php?msg=User introuvable');
                    exit;
                }



                echo '<p>email: <p id="mail">' . $results[0]['email'] .'</p><input id="newMail" type:"text" name ="newEmail" placeholder="nouvel email">' . '<button onclick="changeEmail()">change email</button></p> <br>';
                echo '<p>login: <p id="login" >' . $results[0]['login'] . '</p><input id="newLogin" type:"text" name ="newLogin" placeholder="nouveau pseudo"><button onclick="changeLogin()">change Login</button> </p> <br>';
                echo '<p>moderator: <p id="moderator">' . $results[0]['moderator'] . ' </p> <button onclick="changeModerator()">change</button> </p> <br>';
                echo '<p>active: <p id="active">' . $results[0]['active'] . '</p> <button onclick="changeactive()">activate/desactive</button> </p> <br>';;
                echo '<p>level: <p id="level">' . $results[0]['userLevel'] . '</p> </p> <br>';
                echo '<p>Creation Date: <p id="date">' . $results[0]['creationDate'] . '</p> </p> <br>';
            }else{
                header('location: searchUser.php');
                exit;
            }
        ?>
    </main>
    <script src="script/profilAdmin.js"></script>
</body>
</html>
