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
        <div id="searchingContaineur">
            <div > 
                <input type ="text" name = "wantedUser" id="searchInput" placeholder="mail or pseudo's user">
            </div>
        <div id="mother">
        </div>
        <table>
            <tr id = 'containeur'></tr>
        </table>
        <script src="script/admin.js"></script>
    </main>
    
</body>
</html>