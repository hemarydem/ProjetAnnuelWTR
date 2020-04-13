<?php
require('includes/config.php');
session_start();
$datetime = date('Y-m-d');//for line 60

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
                
                if(empty($idUser)){
                    header('Location: admin.php?msg=User introuvable');
                    exit;
                }

                $q = 'SELECT USER.email, USER.login, USER.moderator, USER.active, USER.userLevel, USER.creationDate, USER.points, USER.FLAGBAN, USER.COUNTERBAN, LEVEL.name 
                FROM USER 
                INNER JOIN LEVEL ON  LEVEL.idLevel = USER.userLevel WHERE idUser=? ';
                $req = $bdd->prepare($q);
                $req->execute([ $idUser ]);
                $results = $req->fetch(PDO::FETCH_ASSOC);




                echo '<p>email: <p id="mail">' . $results['email'] .'</p><input id="newMail" type:"text" name ="newEmail" placeholder="nouvel email">' . '<button onclick="changeEmail()">change email</button></p> <br>';
                echo '<p>login: <p id="login" >' . $results['login'] . '</p><input id="newLogin" type:"text" name ="newLogin" placeholder="nouveau pseudo"><button onclick="changeLogin()">change Login</button> </p> <br>';
                echo '<p>moderator: <p id="moderator">' . $results['moderator'] . ' </p> <button onclick="changeModerator()">change</button> </p> <br>';
                echo '<p>active: <p id="active">' . $results['active'] . '</p> <button onclick="changeactive()">activate/desactive</button> </p> <br>';;
                echo '<p>level: <p id="idlevel">' . $results['name'] . '</p> </p> <br>';
                echo '<select name="level">';
                //select the levels
                $q = 'SELECT name FROM LEVEL';
                $req = $bdd->query($q);
                $result = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $key => $value){
                  echo ' <option>' . $value['name'] . '</option>';
                }
                echo '<select>';
                echo'<button onclick="ChangeUserLevel()">nouveau Niveau</button> <button onclick="removePoints()">retirer</button></p> <br>';
                echo '<p>points: <p id="points">' . $results['points'] . '</p> <input id="tankPoints" type:"text" name ="tankPoints" placeholder="ajouter ou retirer points">'.'<button onclick="addPoints()">Ajouter</button> <button onclick="removePoints()">retirer</button></p> <br>';
                echo '<p>Creation Date: <p id="date">' . $results['creationDate'] . '</p> </p> <br>';
                echo '<p>Ban nomnbre de jour :<input id="days" type:"text" placeholder="days"><button onclick="banne()">bannir</button>';
                echo '<p>nombre de ban ' . $results['COUNTERBAN'].'</p>';
                if($results['FLAGBAN'] > $datetime){
                    echo '<h1>BANNNE jusqu\'au '.$results['FLAGBAN'].'</h1>';
                    echo '<button onclick="endBanne()">arreter le ban</button>';
                }
            }else{
                header('location: searchUser.php');
                exit;
            }
        ?>
    </main>
    <script src="script/profilAdmin.js"></script>
</body>
</html>
