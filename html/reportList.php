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
        
        <div id="searchingButtonContaineur">
            <button onclick="searchReportTopic()"> afficher topic reporter</button>
            <button onclick="searchReportEnigma()"> afficher enigme reporter</button>
            <button onclick="">both search</button>
        </div>
        <div id="mother">
        </div>
        <script src="script/reportListAjax.js"></script>
    </main>
</body>
</html>