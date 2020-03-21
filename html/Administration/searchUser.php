<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://thomerlas.online/style/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://thomerlas.online/style/css/header.css">
    <link rel="icon" type="image/png" href="https://thomerlas.online/img/logo/LockYellow.png"/>
    <link rel="stylesheet" type="text/css" href="searchUserCss.css">
    <title>searchUser</title>
</head>
<body>
    <?php
        include('../includes/header.php');
    ?>
    <div id="searchingContaineur">
        <div > 
            <input type = "text" name = "wantedUser" id="searchByMail" placeholder="write the user's mail">
            <button onclick="searchUserByMail()">search</button>
        </div>
        <div>
            <input type = "text" name = "wantedUser" id="searchBypseudo" placeholder="write the user pseudo">
            <button onclick="searchUserByPseudo()">search</button>
        </div>
        <button onclick="NodeRemove()">remove</button>
    </div>
    
    <div id="mother"></div>
    <table>
        <tr id = 'containeur'></tr>
    </table>
    <script src="index.js"></script>
</body>
</html>