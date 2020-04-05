<?php
require('includes/config.php');
session_start();
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
    <main>
        <?php
        include('includes/adminHeader.php');
        ?>
        <div id="formCreationLevel">
            <label>nom niveau</label>
            <input type="text" id="name" placeholder="nom du niveau">
            <div>
                <div>
                   <p>trop court </p> <div id="shorter" class="circle"></div>
                </div>
                <div>
                 <p>trop long </p><div id="longer" class="circle"></div>
                </div>
            </div>
            <br>
            <label>seuil niveau</label>
            <input type="text"id='threshold' placeholder="rentrer le seuil numérique du niveau">
            <button onclick="creationLevel()"></button>
        </div>
       <div id="createdToDay"></div>
        <script src="script/levelCreation.js"></script>
    </main>
</body>
</html>