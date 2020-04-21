<?php
    require('includes/config.php');
    if(isset($_POST['idUser']) && isset($_POST['idEnigma'])) {
        $req = $bdd ->prepare('SELECT gain FROM ENIGMA WHERE idEnigma = ?');
        $req->execute([$_POST['idEnigma']]);
        $results = $req->fetch(PDO::FETCH_ASSOC);
         print_r($results);

        $req = $bdd ->prepare('UPDATE USER SET points = points + ? WHERE idUser = ?');
        $req->execute([$results['gain'],$_POST['idUser']]);

        $req = $req = $bdd ->prepare('SELECT points FROM USER WHERE idUser = ?');
        $req->execute([$_POST['idUser']]);
        $results = $req->fetch(PDO::FETCH_ASSOC);
        echo $results['points'];
    }
?>