<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>searchUser</title>
</head>
<body>
    <div> 
        <input type = "text" name = "wantedUser" id="searchByMail" placeholder="write the user's mail">
        <button onclick="searchUserByMail()">search</button>
    </div>
    <div>
        <input type = "text" name = "wantedUser" id="searchBypseudo" placeholder="write the user pseudo">
        <button onclick="searchUserByPseudo()">search</button>
    </div>
    <button onclick="NodeRemove()">remove</button>
    <div id="mother"></div>
    <table>
        <tr id = 'containeur'></tr>
    </table>
    <script src="index.js"></script>
</body>
</html>