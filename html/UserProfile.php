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

                $req = $bdd->prepare('SELECT idUser FROM USER WHERE email = ?');
                $req->execute([ $_GET['email'] ]);
                $result = $req->fetch(PDO::FETCH_ASSOC);
                $idUser = $result['idUser'];

                $q = 'SELECT email, login, moderator, active, userLevel, creationDate FROM USER WHERE idUser=?';
                $req = $bdd->prepare($q);
                $req->execute([ $idUser ]);
                $results = $req->fetch(PDO::FETCH_ASSOC);

                if( count( $results ) == 0 ){
                    header('Location: admin.php?msg=User introuvable');
                    exit;
                }



                echo '<p>email: <p id="mail">' . $results['email'] .'</p><input id="newMail" type:"text" name ="newEmail" placeholder="nouvel email">' . '<button onclick="changeEmail()">change email</button></p> <br>';
                echo '<p>login: <p id="login" >' . $results['login'] . '</p><input id="newLogin" type:"text" name ="newLogin" placeholder="nouveau pseudo"><button onclick="changeLogin()">change Login</button> </p> <br>';
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
