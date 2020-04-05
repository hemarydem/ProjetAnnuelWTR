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


            if(isset($_GET['idLevel'])) {

                $idLevel = $_GET['idLevel'];

                $q = 'SELECT name, threshold FROM LEVEL WHERE idLevel=?';
                $req = $bdd->prepare($q);
                $req->execute([ $idLevel ]);
                $results = $req->fetch(PDO::FETCH_ASSOC);

                if( count( $results ) == 0 ){
                    header('Location: levelSearch.php?msg=niveau introuvable');
                    exit;
                }
                echo '<p>id: <p id="idLevel">' . $idLevel .'</p></p><br>';
                echo '<p>Nom: <p id="name">' . $results['name'] .'</p></p><input id="newName" type:"text" name ="newName" placeholder="nouveau Nom">' . '<button onclick="changeLevelName()">change Level Name</button></p> <br>';
                echo '<p>Seuil d\'expérience: <p id="threshold" >' . $results['threshold'] . '</p><input id="newThreshold" type:"text" name ="newThreshold" placeholder="nouveau seuil"><button onclick="changeThreshold()">change threshold</button> </p> <br>';
            }else{
                header('location: searchUser.php');
                exit;
            }
        ?>
    </main>
    <script src="script/levelManageAjax.js"></script>
</body>
</html>
