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
        include('includes/adminHeader.php');
        ?>
        <div id="formCreationLevel">
        <canvas id="myCanvas" width="200" height="100"></canvas>
            <input type="text" id="name" placeholder="nom du niveau">
            <input type="text"id='threshold' placeholder="rentrer le seuil numérique du niveau">
        </div>
       
        <script src="script/levelCreation.js"></script>
    </main>
</body>
</html>