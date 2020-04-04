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
        <div id="searchingContaineur">
            <div > 
                <h1>by name</h1> 
                <input type ="text"  id="wantedLevel" placeholder="write level's name">
            </div>
            <div>
                <h1>by Threshold</h1> 
            <input type ="text"  id="wantedThreshold" placeholder="write the number over the threshold">
            </div>
            <div > 
                <h1>by name and Threshold</h1> 
                <input type ="text"  id="wantedLevelB" placeholder="write level's name">
                <input type ="text"  id="wantedThresholdB" placeholder="write the number over the threshold">
                <button onclick="searchLevelByBoth()">both search</button>
            </div>
        <div id="mother">
        </div>
        <table>
            <tr id = 'containeur'></tr>
        </table>
        <script src="script/levelAdmin.js"></script>
    </main>
</body>
</html>