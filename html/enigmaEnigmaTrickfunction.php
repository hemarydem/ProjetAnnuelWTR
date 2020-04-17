<?php
    require('includes/config.php');
    if(isset($_GET['id'])) {
        $req = $bdd ->prepare('SELECT trick FROM ENIGMA WHERE idEnigma = ?');
        $req->execute([$_GET['id']]);
        $results = $req->fetch(PDO::FETCH_ASSOC);
        echo $results['trick'];
    }
?>